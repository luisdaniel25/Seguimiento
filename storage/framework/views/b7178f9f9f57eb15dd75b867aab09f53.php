<?php $__env->startSection('title', 'Listado de Fichas de Caracterización'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Fichas</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <a href="<?php echo e(route('Fichas.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Ficha de Caracterización
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Código</th>
                        <th>Denominación</th>
                        <th>Cupo</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $fichasdecaracterizacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ficha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($ficha->NIS); ?></td>
                            <td><?php echo e($ficha->Codigo); ?></td>
                            <td><?php echo e($ficha->Denominacion); ?></td>
                            <td><?php echo e($ficha->Cupo); ?></td>
                            <td><?php echo e($ficha->Observaciones); ?></td>

                            
                            <td>
                                <a href="<?php echo e(route('Fichas.show', $ficha->NIS)); ?>" class="btn btn-sm btn-info" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="<?php echo e(route('Fichas.edit', $ficha)); ?>" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="<?php echo e(route('Fichas.destroy', $ficha->NIS)); ?>" method="POST"
                                    style="display:inline;" class="form-eliminar">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                No hay fichas registradas
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            
            <div class="mt-3 d-flex justify-content-center">
                <?php echo e($fichasdecaracterizacion->links()); ?>

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
                        text: "¡No podrás revertir esto!",
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/Fichas/index.blade.php ENDPATH**/ ?>