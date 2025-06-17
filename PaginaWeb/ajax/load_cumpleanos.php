<?php
require_once ("../cn/connect2.php");

$mesActual = date('n'); // Mes actual (1-12)
$añoActual = date('Y');

// Obtener el nombre del mes actual en español
$mesesEs = [
    1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
    5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
    9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
];
$nombreMesActual = $mesesEs[$mesActual];

try {
    $query = "SELECT nombre_personal, fnac_personal, edad_personal 
              FROM personal 
              WHERE status_personal = 1 
              AND fnac_personal IS NOT NULL 
              AND fnac_personal != '' 
              AND MONTH(STR_TO_DATE(fnac_personal, '%Y-%m-%d')) = ? 
              ORDER BY DAY(STR_TO_DATE(fnac_personal, '%Y-%m-%d')) ASC";
    
    $stmt = $db2->prepare($query);
    $stmt->execute([$mesActual]);
    
    $cumpleanos = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Validar que la fecha tenga el formato correcto YYYY-MM-DD
        if (preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/', $row['fnac_personal'])) {
            $fechaNac = DateTime::createFromFormat('Y-m-d', $row['fnac_personal']);
            if ($fechaNac) {
                $hoy = new DateTime();
                $nuevaEdad = $hoy->diff($fechaNac)->y;
                
                // Verificar si ya cumplió años este año
                $cumpleanoEsteAno = DateTime::createFromFormat('Y-m-d', 
                    $añoActual . '-' . $fechaNac->format('m') . '-' . $fechaNac->format('d'));
                
                if ($cumpleanoEsteAno > $hoy) {
                    $nuevaEdad = $nuevaEdad + 1;
                }
                
                $row['nueva_edad'] = $nuevaEdad;
                $row['dia_cumple'] = $fechaNac->format('d');
                $row['mes_cumple'] = $fechaNac->format('n');
                $cumpleanos[] = $row;
            }
        }
    }
    
} catch (Exception $e) {
    $cumpleanos = [];
    error_log("Error en consulta cumpleaños: " . $e->getMessage());
}
?>

<style>
    /* Modal overlay */
    .modal-overlay-cumple {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        display: flex !important;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.4s ease;
        overflow: hidden;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Modal content - CENTRADO PERFECTO */
    .modal-content-cumple {
        background: linear-gradient(145deg, #8B2635, #A13344);
        border: 3px solid #F5E6B3;
        border-radius: 20px;
        padding: 0;
        max-width: 650px;
        width: 90%;
        max-height: 85vh;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.6);
        animation: slideInBounce 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        position: relative;
        margin: auto;
    }

    @keyframes slideInBounce {
        0% { 
            transform: translateY(-100px) scale(0.8);
            opacity: 0;
        }
        60% {
            transform: translateY(10px) scale(1.02);
            opacity: 0.9;
        }
        100% { 
            transform: translateY(0) scale(1);
            opacity: 1;
        }
    }

    /* Canvas para confeti */
    .confetti-canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 10;
        border-radius: 20px;
        overflow: hidden;
    }

    /* Modal header */
    .modal-header-cumple {
        background: linear-gradient(145deg, #F5E6B3, #E8D49A);
        color: #8B2635;
        padding: 25px;
        text-align: center;
        border-bottom: 3px solid #8B2635;
        position: relative;
        overflow: hidden;
    }

    .modal-title-cumple {
        font-size: 28px;
        font-weight: bold;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(139, 38, 53, 0.3);
        animation: titlePulse 2s ease-in-out infinite;
    }

    @keyframes titlePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .close-btn-cumple {
        position: absolute;
        top: 20px;
        right: 25px;
        background: #8B2635;
        color: #F5E6B3;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 24px;
        font-weight: bold;
        line-height: 1;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .close-btn-cumple:hover {
        background: #A13344;
        transform: scale(1.15) rotate(90deg);
        box-shadow: 0 6px 12px rgba(0,0,0,0.4);
    }

    /* Modal body */
    .modal-body-cumple {
        padding: 30px;
        max-height: 450px;
        overflow-y: auto;
        background: linear-gradient(145deg, #8B2635, #A13344);
        position: relative;
    }

    /* Scrollbar personalizado */
    .modal-body-cumple::-webkit-scrollbar {
        width: 12px;
    }

    .modal-body-cumple::-webkit-scrollbar-track {
        background: rgba(245, 230, 179, 0.2);
        border-radius: 6px;
        margin: 5px;
    }

    .modal-body-cumple::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #F5E6B3, #E8D49A);
        border-radius: 6px;
        border: 2px solid transparent;
        background-clip: content-box;
    }

    .modal-body-cumple::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #E8D49A, #D4C085);
    }

    /* Lista de cumpleañeros */
    .cumpleanos-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .cumpleanos-item {
        background: rgba(245, 230, 179, 0.15);
        border: 2px solid #F5E6B3;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 18px;
        transition: all 0.4s ease;
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .cumpleanos-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(245, 230, 179, 0.2), 
            transparent);
        transition: left 0.6s ease;
    }

    .cumpleanos-item:hover::before {
        left: 100%;
    }

    .cumpleanos-item:hover {
        background: rgba(245, 230, 179, 0.25);
        transform: translateX(8px) scale(1.02);
        box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        border-color: #E8D49A;
    }

    .cumpleanos-item:last-child {
        margin-bottom: 0;
    }

    .cumpleanos-name {
        color: #F5E6B3;
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }

    .cumpleanos-details {
        color: #E8D49A;
        font-size: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .cumpleanos-date {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
    }

    .cumpleanos-age {
        background: linear-gradient(45deg, #F5E6B3, #E8D49A);
        color: #8B2635;
        padding: 6px 16px;
        border-radius: 25px;
        font-weight: bold;
        font-size: 14px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.2);
        border: 2px solid #8B2635;
    }

    .no-cumpleanos {
        text-align: center;
        color: #F5E6B3;
        font-size: 20px;
        padding: 50px 30px;
        border: 3px dashed #F5E6B3;
        border-radius: 20px;
        background: rgba(245, 230, 179, 0.1);
        animation: gentlePulse 3s ease-in-out infinite;
    }

    @keyframes gentlePulse {
        0%, 100% { opacity: 0.8; }
        50% { opacity: 1; }
    }

    .cake-emoji {
        font-size: 24px;
        margin-right: 5px;
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-8px); }
        60% { transform: translateY(-4px); }
    }

    .calendar-emoji {
        font-size: 16px;
        animation: rotate 4s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Efectos especiales para cumpleaños de hoy */
    .cumple-hoy {
        border: 3px solid #FFD700 !important;
        background: rgba(255, 215, 0, 0.2) !important;
        animation: especialGlow 2s ease-in-out infinite;
    }

    @keyframes especialGlow {
        0%, 100% { box-shadow: 0 0 20px rgba(255, 215, 0, 0.5); }
        50% { box-shadow: 0 0 30px rgba(255, 215, 0, 0.8); }
    }

    .cumple-hoy .cumpleanos-name {
        color: #FFD700 !important;
        animation: textGlow 2s ease-in-out infinite;
    }

    @keyframes textGlow {
        0%, 100% { text-shadow: 0 0 10px rgba(255, 215, 0, 0.8); }
        50% { text-shadow: 0 0 20px rgba(255, 215, 0, 1); }
    }
</style>

<div id="cumpleanosModal" class="modal-overlay-cumple">
    <div class="modal-content-cumple">
        <canvas class="confetti-canvas" id="confettiCanvas"></canvas>
        
        <div class="modal-header-cumple">
            <h2 class="modal-title-cumple">🎉 Cumpleañeros de <?= ucfirst($nombreMesActual) ?> 🎉</h2>
            <button class="close-btn-cumple" onclick="cerrarModalCumple()">×</button>
        </div>
        
        <div class="modal-body-cumple">
            <ul class="cumpleanos-list">
                <?php if (empty($cumpleanos)): ?>
                    <li class="no-cumpleanos">
                        <div style="font-size: 48px; margin-bottom: 15px;">🎂</div>
                        <div>No hay cumpleañeros en <?= $nombreMesActual ?></div>
                        <div style="font-size: 14px; margin-top: 10px; opacity: 0.8;">
                            ¡Pero siempre hay motivos para celebrar! 🎊
                        </div>
                    </li>
                <?php else: ?>
                    <?php 
                    $hoy = date('j'); // Día actual
                    $mesHoy = date('n'); // Mes actual
                    foreach ($cumpleanos as $persona): 
                        $fechaNac = DateTime::createFromFormat('Y-m-d', $persona['fnac_personal']);
                        $dia = $fechaNac->format('j'); // Sin ceros a la izquierda
                        $mes = $fechaNac->format('F');
                        
                        // Verificar si es cumpleaños hoy
                        $esCumpleHoy = ($dia == $hoy && $persona['mes_cumple'] == $mesHoy);
                        
                        // Traducir el mes al español
                        $mesesEsCompleto = [
                            'January' => 'enero', 'February' => 'febrero', 'March' => 'marzo',
                            'April' => 'abril', 'May' => 'mayo', 'June' => 'junio',
                            'July' => 'julio', 'August' => 'agosto', 'September' => 'septiembre',
                            'October' => 'octubre', 'November' => 'noviembre', 'December' => 'diciembre'
                        ];
                        $mes = $mesesEsCompleto[$mes] ?? $mes;
                    ?>
                        <li class="cumpleanos-item <?= $esCumpleHoy ? 'cumple-hoy' : '' ?>">
                            <div class="cumpleanos-name">
                                <span class="cake-emoji">🎂</span>
                                <?= htmlspecialchars($persona['nombre_personal']) ?>
                                <?php if ($esCumpleHoy): ?>
                                    <span style="color: #FFD700; font-size: 16px;">🎊 ¡HOY!</span>
                                <?php endif; ?>
                            </div>
                            <div class="cumpleanos-details">
                                <div class="cumpleanos-date">
                                    <span class="calendar-emoji">📅</span>
                                    <?= $dia ?> de <?= $mes ?>
                                </div>
                                <div class="cumpleanos-age">
                                    <?= $persona['nueva_edad'] ?> años
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<script>
    // ===== SISTEMA DE CONFETI =====
    class ConfettiSystem {
        constructor(canvas) {
            this.canvas = canvas;
            this.ctx = canvas.getContext('2d');
            this.particles = [];
            this.colors = ['#FFD700', '#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#DDA0DD', '#98D8C8'];
            
            this.resizeCanvas();
            this.createParticles();
            this.animate();
        }
        
        resizeCanvas() {
            const rect = this.canvas.parentElement.getBoundingClientRect();
            this.canvas.width = rect.width;
            this.canvas.height = rect.height;
        }
        
        createParticles() {
            for (let i = 0; i < 100; i++) {
                this.particles.push({
                    x: Math.random() * this.canvas.width,
                    y: Math.random() * this.canvas.height - this.canvas.height,
                    vx: (Math.random() - 0.5) * 3,
                    vy: Math.random() * 3 + 2,
                    size: Math.random() * 6 + 3,
                    color: this.colors[Math.floor(Math.random() * this.colors.length)],
                    rotation: Math.random() * 360,
                    rotationSpeed: (Math.random() - 0.5) * 10,
                    opacity: Math.random() * 0.8 + 0.2,
                    shape: Math.random() > 0.5 ? 'circle' : 'square'
                });
            }
        }
        
        updateParticles() {
            for (let i = this.particles.length - 1; i >= 0; i--) {
                const p = this.particles[i];
                
                p.x += p.vx;
                p.y += p.vy;
                p.rotation += p.rotationSpeed;
                p.vy += 0.1; // Gravedad
                p.opacity -= 0.005;
                
                // Reposicionar si sale de pantalla
                if (p.y > this.canvas.height || p.opacity <= 0) {
                    p.x = Math.random() * this.canvas.width;
                    p.y = -20;
                    p.vy = Math.random() * 3 + 2;
                    p.vx = (Math.random() - 0.5) * 3;
                    p.opacity = Math.random() * 0.8 + 0.2;
                }
            }
        }
        
        drawParticles() {
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            
            for (const p of this.particles) {
                this.ctx.save();
                this.ctx.globalAlpha = p.opacity;
                this.ctx.translate(p.x, p.y);
                this.ctx.rotate(p.rotation * Math.PI / 180);
                this.ctx.fillStyle = p.color;
                
                if (p.shape === 'circle') {
                    this.ctx.beginPath();
                    this.ctx.arc(0, 0, p.size, 0, Math.PI * 2);
                    this.ctx.fill();
                } else {
                    this.ctx.fillRect(-p.size/2, -p.size/2, p.size, p.size);
                }
                
                this.ctx.restore();
            }
        }
        
        animate() {
            this.updateParticles();
            this.drawParticles();
            requestAnimationFrame(() => this.animate());
        }
    }

    // Inicializar confeti
    const confettiCanvas = document.getElementById('confettiCanvas');
    const confettiSystem = new ConfettiSystem(confettiCanvas);

    // ===== FUNCIONES DEL MODAL =====
    function cerrarModalCumple() {
        $('#cumpleanosModal').fadeOut(400, function(){
            $(this).remove();
        });
        $('body').css('overflow', 'auto');
    }

    // Cerrar modal al hacer clic fuera
    $(document).on('click', '#cumpleanosModal', function(e) {
        if (e.target === this) {
            cerrarModalCumple();
        }
    });

    // Cerrar modal con tecla Escape
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            cerrarModalCumple();
        }
    });

    // Redimensionar canvas al cambiar tamaño de ventana
    $(window).on('resize', function() {
        confettiSystem.resizeCanvas();
    });

    // Mostrar el modal con efecto
    $('#cumpleanosModal').hide().fadeIn(400);
</script>