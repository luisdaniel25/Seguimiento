<?php $__env->startSection('title', 'Subir Archivo'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Registro de Archivo</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Carga</h3>
                </div>

                <form action="<?php echo e(route('archivos.store')); ?>" method="POST" enctype="multipart/form-data" class="form-guardar">

                    <?php echo csrf_field(); ?>

                    <div class="card-body">

                        
                        <div class="form-group">
                            <label>Descripción</label>

                            <input type="text" name="descripcion"
                                class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('descripcion')); ?>" placeholder="Descripción opcional">

                            <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="form-group">
                            <label>Seleccionar Archivo *</label>

                            <div class="custom-file">
                                <input type="file" name="archivo"
                                    class="custom-file-input <?php $__errorArgs = ['archivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>

                                <label class="custom-file-label">
                                    Elegir archivo
                                </label>
                            </div>

                            <?php $__errorArgs = ['archivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger d-block mt-1">
                                    <?php echo e($message); ?>

                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <small class="text-muted">
                                Permitidos: PDF, Word, Excel, Imágenes (Máx 10MB)
                            </small>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="<?php echo e(route('archivos.index')); ?>" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Subir Archivo
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('js'); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Mostrar nombre archivo seleccionado (AdminLTE)
            const inputFile = document.querySelector('.custom-file-input');

            if (inputFile) {
                inputFile.addEventListener('change', function(e) {
                    let fileName = e.target.files[0].name;
                    e.target.nextElementSibling.innerText = fileName;
                });
            }

            // Confirmación SweetAlert
            document.querySelectorAll('.form-guardar').forEach(form => {

                form.addEventListener('submit', function(e) {

                    if (!form.checkValidity()) return;

                    e.preventDefault();

                    Swal.fire({
                        title: '¿Deseas subir el archivo?',
                        text: "El archivo será almacenado en el sistema.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, subir',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });

            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/archivos/create.blade.php ENDPATH**/ ?>