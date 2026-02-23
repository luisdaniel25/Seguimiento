<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('title', 'Roles Administrativos'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Listado de Roles Administrativos</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Roles Registrados</h3>
                    <a href="<?php echo e(route('rolesadministrativos.create')); ?>" class="btn btn-success btn-sm">
                        Nuevo Rol
                    </a>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($rol->NIS); ?></td>
                                    <td><?php echo e($rol->Descripcion); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('rolesadministrativos.show', $rol->NIS)); ?>"
                                            class="btn btn-info btn-sm">Ver</a>
                                        <a href="<?php echo e(route('rolesadministrativos.edit', $rol->NIS)); ?>"
                                            class="btn btn-warning btn-sm">Editar</a>

                                        <form action="<?php echo e(route('rolesadministrativos.destroy', $rol->NIS)); ?>" method="POST"
                                            style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Desea eliminar este rol?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center">No hay roles registrados</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <?php echo e($roles->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/Rolesadministrativos/index.blade.php ENDPATH**/ ?>