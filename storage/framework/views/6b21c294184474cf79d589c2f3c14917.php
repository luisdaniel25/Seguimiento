<?php $__env->startSection('title', 'Listado EPS'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>EPS</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">

        
        <div class="card-header">
            <a href="<?php echo e(route('eps.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Registro
            </a>
        </div>

        
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Número Documento</th>
                        <th>Denominacion</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $eps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($ep->nis); ?></td>
                            <td><?php echo e($ep->numdoc); ?></td>
                            <td><?php echo e($ep->denominacion); ?></td>
                            <td><?php echo e($ep->observaciones); ?></td>

                            
                            <td>
                                <a href="<?php echo e(route('eps.show', $ep->nis)); ?>" class="btn btn-sm btn-info" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="<?php echo e(route('eps.edit', $ep->nis)); ?>" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="<?php echo e(route('eps.destroy', $ep->nis)); ?>" method="POST" style="display:inline;">
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
                            <td colspan="9" class="text-center">
                                No hay registros de EPS disponibles.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            
            <div class="mt-3 d-flex justify-content-center">
                <?php echo e($eps->links()); ?>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/eps/index.blade.php ENDPATH**/ ?>