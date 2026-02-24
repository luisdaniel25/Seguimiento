<?php $__env->startSection('title', 'Listado de Archivos'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Archivos</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">

        <div class="card-header">
            <a href="<?php echo e(route('archivos.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Archivo
            </a>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Archivo</th>
                        <th>Tipo</th>
                        <th>Tamaño</th>
                        <th>Fecha</th>
                        <th width="160">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $archivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>

                            
                            <td>

                                
                                <?php if(Str::startsWith($archivo->tipo_mime, 'image')): ?>
                                    <img src="<?php echo e(asset('storage/' . $archivo->ruta)); ?>" width="40" class="mr-2 rounded">
                                <?php else: ?>
                                    
                                    <?php if(Str::contains($archivo->tipo_mime, 'pdf')): ?>
                                        <i class="fas fa-file-pdf text-danger mr-2"></i>
                                    <?php elseif(Str::contains($archivo->tipo_mime, 'word')): ?>
                                        <i class="fas fa-file-word text-primary mr-2"></i>
                                    <?php elseif(Str::contains($archivo->tipo_mime, 'excel')): ?>
                                        <i class="fas fa-file-excel text-success mr-2"></i>
                                    <?php else: ?>
                                        <i class="fas fa-file text-secondary mr-2"></i>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php echo e($archivo->nombre_original); ?>


                                <?php if($archivo->descripcion): ?>
                                    <br>
                                    <small class="text-muted">
                                        <?php echo e($archivo->descripcion); ?>

                                    </small>
                                <?php endif; ?>

                            </td>

                            
                            <td>
                                <span class="badge badge-info">
                                    <?php echo e($archivo->tipo_mime); ?>

                                </span>
                            </td>

                            
                            <td><?php echo e($archivo->tamano_formateado); ?></td>

                            
                            <td><?php echo e($archivo->created_at->format('d/m/Y')); ?></td>

                            
                            <td>

                                <a href="<?php echo e(route('archivos.download', $archivo->id)); ?>" class="btn btn-sm btn-info"
                                    title="Descargar">
                                    <i class="fas fa-download"></i>
                                </a>

                                <form action="<?php echo e(route('archivos.destroy', $archivo->id)); ?>" method="POST"
                                    style="display:inline;" class="form-eliminar">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                No hay archivos registrados
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>

            </table>

            
            <div class="mt-3 d-flex justify-content-center">
                <?php echo e($archivos->links()); ?>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('js'); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Confirmación eliminar
            document.querySelectorAll('.form-eliminar').forEach(form => {

                form.addEventListener('submit', function(e) {

                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "El archivo será eliminado permanentemente.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });

            });

            // Mensaje éxito
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?php echo e(session('success')); ?>',
                    timer: 3000,
                    showConfirmButton: false
                });
            <?php endif; ?>

        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/archivos/index.blade.php ENDPATH**/ ?>