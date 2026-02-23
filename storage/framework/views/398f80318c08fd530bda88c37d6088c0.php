<?php $__env->startSection('title', 'Regionales'); ?>


<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Regionales</h1>

        <a href="<?php echo e(route('regionales.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nueva Regional
        </a>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>NIS</th>
                            <th>Código</th>
                            <th>Denominación</th>
                            <th>Observaciones</th>
                            <th width="250">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $regionales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($regional->NIS); ?></td>
                                <td><?php echo e($regional->Codigo); ?></td>
                                <td><?php echo e($regional->Denominacion); ?></td>
                                <td><?php echo e($regional->Observaciones ?? 'Sin observaciones'); ?></td>
                                <td>

                                    <a href="<?php echo e(route('regionales.show', $regional->NIS)); ?>" class="btn btn-sm btn-info"
                                        title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>


                                    <a href="<?php echo e(route('regionales.edit', $regional->NIS)); ?>" class="btn btn-sm btn-warning"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="<?php echo e(route('regionales.destroy', $regional->NIS)); ?>" method="POST"
                                        style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Está seguro de eliminar?')" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    No hay regionales registradas
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

            
            <div class="mt-3">
                <?php echo e($regionales->links()); ?>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/Regionales/index.blade.php ENDPATH**/ ?>