<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de Documentos</title>
    <style>
        .documento-container {
            max-width: 100%;
            background: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .documento-header {
            background: #4a5568;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .documento-content {
            padding: 20px;
        }

        .form-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .section-title {
            color: #2d3748;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            padding: 8px 12px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .progress-container {
            background: #edf2f7;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #48bb78, #38a169);
            transition: width 0.3s ease;
            border-radius: 4px;
        }

        .progress-text {
            font-size: 12px;
            color: #4a5568;
            text-align: center;
        }

        .doc-selector {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .doc-card {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 12px;
        }

        .doc-card:hover {
            border-color: #4299e1;
            transform: translateY(-1px);
        }

        .doc-card.selected {
            border-color: #48bb78;
            background: #f0fff4;
        }

        .doc-number {
            font-size: 18px;
            font-weight: bold;
            color: #48bb78;
            margin-bottom: 4px;
        }

        .dropzone {
            border: 2px dashed #cbd5e0;
            border-radius: 6px;
            padding: 30px;
            text-align: center;
            background: #f7fafc;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 15px;
        }

        .dropzone:hover, .dropzone.dragover {
            border-color: #4299e1;
            background: #ebf8ff;
        }

        .dropzone p {
            margin: 0;
            color: #4a5568;
            font-size: 14px;
        }

        .dropzone label {
            color: #4299e1;
            text-decoration: underline;
            cursor: pointer;
            font-weight: 500;
        }

        #archivos {
            display: none;
        }

        .btn {
            background: #48bb78;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
            width: 100%;
        }

        .btn:hover:not(:disabled) {
            background: #38a169;
        }

        .btn:disabled {
            background: #a0aec0;
            cursor: not-allowed;
        }

        .archivos-list {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            background: white;
        }

        .archivo-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border-bottom: 1px solid #f7fafc;
            font-size: 13px;
        }

        .archivo-item:last-child {
            border-bottom: none;
        }

        .archivo-nombre {
            font-weight: 500;
            color: #2d3748;
        }

        .archivo-tipo {
            background: #4299e1;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
        }

        .tabla-control {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            background: white;
            border-radius: 4px;
            overflow: hidden;
        }

        .tabla-control th,
        .tabla-control td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .tabla-control th {
            background: #edf2f7;
            color: #4a5568;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
        }

        .tabla-control tr:hover {
            background: #f7fafc;
        }

        .status {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .status.cargado {
            background: #c6f6d5;
            color: #22543d;
        }

        .status.pendiente {
            background: #fefcbf;
            color: #744210;
        }

        .success-message {
            background: #c6f6d5;
            color: #22543d;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
            border-left: 4px solid #48bb78;
        }

        .doc-selected-info {
            background: #ebf8ff;
            color: #2b6cb0;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 10px;
            border-left: 3px solid #4299e1;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .doc-selector {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="documento-container">
        <div class="documento-header">
             Carga de Documentos por Residente
        </div>
        
        <div class="documento-content">
            <!-- Información del Residente -->
            <div class="form-section">
                
                
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progress-fill" style="width: 0%"></div>
                    </div>
                    <div class="progress-text" id="progress-text">0 de 8 documentos cargados</div>
                </div>
            </div>

            <!-- Selección y Carga -->
            <div class="form-section">
                <div class="section-title">Seleccionar y Cargar Documento</div>
                
                <div class="doc-selector">
                    <div class="doc-card" data-doc="1">
                        <div class="doc-number">1</div>
                        <div>Identificación</div>
                    </div>
                    <div class="doc-card" data-doc="2">
                        <div class="doc-number">2</div>
                        <div>CURP</div>
                    </div>
                    <div class="doc-card" data-doc="3">
                        <div class="doc-number">3</div>
                        <div>NSS</div>
                    </div>
                    <div class="doc-card" data-doc="4">
                        <div class="doc-number">4</div>
                        <div>Médico</div>
                    </div>
                    <div class="doc-card" data-doc="5">
                        <div class="doc-number">5</div>
                        <div>Ingreso</div>
                    </div>
                    <div class="doc-card" data-doc="6">
                        <div class="doc-number">6</div>
                        <div>Responsable</div>
                    </div>
                    <div class="doc-card" data-doc="7">
                        <div class="doc-number">7</div>
                        <div>Seguro</div>
                    </div>
                    <div class="doc-card" data-doc="8">
                        <div class="doc-number">8</div>
                        <div>Otros</div>
                    </div>
                </div>
                
                <div id="doc-selected-info" class="doc-selected-info" style="display: none;"></div>
                
                <div class="dropzone" id="dropzone">
                    <p>Arrastre el archivo aquí <label for="archivos">o haga clic para seleccionar</label></p>
                    <p style="font-size: 12px; color: #718096; margin-top: 5px;">PDF, JPG, PNG, DOC permitidos</p>
                    <input type="file" id="archivos" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
                </div>
                
                <button class="btn" id="btn-cargar" disabled>
                     Cargar Documento
                </button>
            </div>

            <!-- Archivos Cargados -->
            <div class="form-section">
                <div class="section-title">Documentos Cargados</div>
                <div class="archivos-list" id="archivos-list">
                    <div style="padding: 20px; text-align: center; color: #718096; font-size: 13px;">
                        No hay documentos cargados
                    </div>
                </div>
            </div>

            <!-- Tabla de Control -->
            <div class="form-section">
                <div class="section-title">Control de Documentos</div>
                <div style="overflow-x: auto;">
                    <table class="tabla-control">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th>Archivo</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-control">
                            <tr>
                                <td colspan="5" style="text-align: center; color: #718096; padding: 20px;">
                                    No hay documentos registrados
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Variables globales
        let documentoSeleccionado = null;
        let archivoSeleccionado = null;
        let documentosCargados = {};
        let nombreResidente = '';
        let idResidente = '';

        // Tipos de documentos
        const tiposDocumentos = {
            1: 'Identificación',
            2: 'CURP',
            3: 'NSS',
            4: 'Médico',
            5: 'Ingreso',
            6: 'Responsable',
            7: 'Seguro',
            8: 'Otros'
        };

        // Inicializar
        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
            initializeDocumentCards();
        });

        function initializeEventListeners() {
            const dropzone = document.getElementById('dropzone');
            const archivos = document.getElementById('archivos');
            const btnCargar = document.getElementById('btn-cargar');
            const nombreInput = document.getElementById('nombre_residente');
            const idInput = document.getElementById('id_residente');

            // Eventos de drag and drop
            dropzone.addEventListener('dragover', handleDragOver);
            dropzone.addEventListener('drop', handleDrop);
            dropzone.addEventListener('dragleave', handleDragLeave);
            dropzone.addEventListener('click', () => archivos.click());

            // Evento de selección de archivo
            archivos.addEventListener('change', handleFileSelect);

            // Evento de carga
            btnCargar.addEventListener('click', uploadFile);

            // Eventos de información del residente
            nombreInput.addEventListener('input', updateResidentInfo);
            idInput.addEventListener('input', updateResidentInfo);
        }

        function initializeDocumentCards() {
            const docCards = document.querySelectorAll('.doc-card');
            docCards.forEach(card => {
                card.addEventListener('click', () => selectDocument(card.dataset.doc));
            });
        }

        function selectDocument(docNumber) {
            // Remover selección anterior
            document.querySelectorAll('.doc-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Seleccionar nuevo documento
            const selectedCard = document.querySelector(`[data-doc="${docNumber}"]`);
            selectedCard.classList.add('selected');
            
            documentoSeleccionado = docNumber;
            
            const infoDiv = document.getElementById('doc-selected-info');
            infoDiv.textContent = `✓ Documento ${docNumber} seleccionado: ${tiposDocumentos[docNumber]}`;
            infoDiv.style.display = 'block';
            
            updateUploadButton();
        }

        function handleDragOver(e) {
            e.preventDefault();
            document.getElementById('dropzone').classList.add('dragover');
        }

        function handleDragLeave(e) {
            e.preventDefault();
            document.getElementById('dropzone').classList.remove('dragover');
        }

        function handleDrop(e) {
            e.preventDefault();
            document.getElementById('dropzone').classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                archivoSeleccionado = files[0];
                updateFileInfo();
            }
        }

        function handleFileSelect(e) {
            if (e.target.files.length > 0) {
                archivoSeleccionado = e.target.files[0];
                updateFileInfo();
            }
        }

        function updateFileInfo() {
            if (archivoSeleccionado) {
                const dropzone = document.getElementById('dropzone');
                dropzone.innerHTML = `
                    <p>✅ <strong>${archivoSeleccionado.name}</strong></p>
                    <p style="font-size: 12px; color: #718096;">${(archivoSeleccionado.size / 1024 / 1024).toFixed(2)} MB - Clic para cambiar</p>
                `;
                updateUploadButton();
            }
        }

        function updateUploadButton() {
            const btnCargar = document.getElementById('btn-cargar');
            const canUpload = documentoSeleccionado && archivoSeleccionado && nombreResidente && idResidente;
            
            btnCargar.disabled = !canUpload;
        }

        function updateResidentInfo() {
            nombreResidente = document.getElementById('nombre_residente').value.trim();
            idResidente = document.getElementById('id_residente').value.trim();
            updateUploadButton();
        }

        function uploadFile() {
            if (!documentoSeleccionado || !archivoSeleccionado || !nombreResidente || !idResidente) {
                alert('Por favor complete toda la información requerida');
                return;
            }

            // Mostrar mensaje de éxito temporal
            showSuccessMessage();

            // Generar nombre de archivo único
            const extension = archivoSeleccionado.name.split('.').pop();
            const timestamp = new Date().toISOString().slice(0,19).replace(/[T:]/g, '_');
            const nombreArchivo = `${nombreResidente.replace(/[^a-zA-Z0-9]/g, '_')}_Doc${documentoSeleccionado}_${timestamp}.${extension}`;

            // Simular carga (aquí iría la llamada AJAX real)
            setTimeout(() => {
                // Guardar documento
                documentosCargados[documentoSeleccionado] = {
                    tipo: documentoSeleccionado,
                    descripcion: tiposDocumentos[documentoSeleccionado],
                    nombreArchivo: nombreArchivo,
                    fecha: new Date().toLocaleDateString('es-ES'),
                    estado: 'cargado'
                };

                // Actualizar interfaz
                updateArchivesList();
                updateControlTable();
                updateProgress();
                resetForm();

            }, 1000);
        }

        function updateArchivesList() {
            const container = document.getElementById('archivos-list');
            const archivos = Object.values(documentosCargados);
            
            if (archivos.length === 0) {
                container.innerHTML = '<div style="padding: 20px; text-align: center; color: #718096; font-size: 13px;">No hay documentos cargados</div>';
                return;
            }

            container.innerHTML = archivos.map(archivo => `
                <div class="archivo-item">
                    <div>
                        <div class="archivo-nombre">${archivo.nombreArchivo}</div>
                        <div style="font-size: 11px; color: #718096;">${archivo.fecha}</div>
                    </div>
                    <div class="archivo-tipo">Doc ${archivo.tipo}</div>
                </div>
            `).join('');
        }

        function updateControlTable() {
            const tbody = document.getElementById('tabla-control');
            const archivos = Object.values(documentosCargados);
            
            if (archivos.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: #718096; padding: 20px;">No hay documentos registrados</td></tr>';
                return;
            }

            tbody.innerHTML = archivos.map(archivo => `
                <tr>
                    <td><strong>Doc ${archivo.tipo}</strong></td>
                    <td>${archivo.descripcion}</td>
                    <td style="font-size: 12px;">${archivo.nombreArchivo}</td>
                    <td>${archivo.fecha}</td>
                    <td><span class="status ${archivo.estado}">${archivo.estado}</span></td>
                </tr>
            `).join('');
        }

        function updateProgress() {
            const totalDocs = 8;
            const cargados = Object.keys(documentosCargados).length;
            const porcentaje = (cargados / totalDocs) * 100;
            
            document.getElementById('progress-fill').style.width = porcentaje + '%';
            document.getElementById('progress-text').textContent = `${cargados} de ${totalDocs} documentos cargados`;
        }

        function resetForm() {
            // Limpiar selección de documento
            document.querySelectorAll('.doc-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Resetear variables
            documentoSeleccionado = null;
            archivoSeleccionado = null;
            
            // Resetear dropzone
            document.getElementById('dropzone').innerHTML = `
                <p>📎 Arrastre el archivo aquí <label for="archivos">o haga clic para seleccionar</label></p>
                <p style="font-size: 12px; color: #718096; margin-top: 5px;">PDF, JPG, PNG, DOC permitidos</p>
            `;
            
            // Limpiar input de archivo
            document.getElementById('archivos').value = '';
            
            // Ocultar info de selección
            document.getElementById('doc-selected-info').style.display = 'none';
            
            // Deshabilitar botón
            updateUploadButton();
        }

        function showSuccessMessage() {
            const existingMessage = document.querySelector('.success-message');
            if (existingMessage) {
                existingMessage.remove();
            }

            const message = document.createElement('div');
            message.className = 'success-message';
            message.innerHTML = '✅ Documento cargado exitosamente';
            
            const firstSection = document.querySelector('.form-section');
            firstSection.parentNode.insertBefore(message, firstSection);
            
            setTimeout(() => {
                message.remove();
            }, 3000);
        }
    </script>
</body>
</html>