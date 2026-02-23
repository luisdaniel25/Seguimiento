<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('title', 'Tipos de Documento'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Listado de Tipos de Documento</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">

            <a href="<?php echo e(route('tiposdocumento.create')); ?>" class="btn btn-primary mb-3">Nuevo Tipo de Documento</a>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tipos de Documento Registrados</h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Denominación</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($tipo->nis); ?></td>
                                    <td><?php echo e($tipo->denominacion); ?></td>
                                    <td><?php echo e($tipo->observaciones); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('tiposdocumento.show', $tipo->nis)); ?>"
                                            class="btn btn-info btn-sm">Ver</a>
                                        <a href="<?php echo e(route('tiposdocumento.edit', $tipo->nis)); ?>"
                                            class="btn btn-warning btn-sm">Editar</a>

                                        <form action="<?php echo e(route('tiposdocumento.destroy', $tipo->nis)); ?>" method="POST"
                                            class="d-inline form-eliminar">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <?php echo e($tipos->links()); ?>

                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Deseas eliminar?',
                        text: "Este tipo de documento será eliminado.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
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

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/Tiposdocumento/index.blade.php ENDPATH**/ ?>