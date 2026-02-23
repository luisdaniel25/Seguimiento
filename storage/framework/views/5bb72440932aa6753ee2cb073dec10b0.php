<?php $__env->startSection('title', 'Centros de Formación'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Centros de Formación</h1>

        <a href="<?php echo e(route('centros.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nuevo Centro
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    <?php endif; ?>

    
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Listado de Centros
                <span class="badge badge-info">
                <?php echo e($centros->total()); ?> registros
            </span>
            </h3>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Dirección</th>
                    <th>Observaciones</th>
                    <th>Regional</th>
                    <th width="160">Acciones</th>
                </tr>
                </thead>

                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $centros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($centro->NIS); ?></td>
                        <td><?php echo e($centro->Codigo); ?></td>
                        <td><?php echo e($centro->Denominacion); ?></td>
                        <td><?php echo e($centro->Direccion); ?></td>
                        <td><?php echo e($centro->Observaciones ?? 'Sin observaciones'); ?></td>
                        <td>
                            <?php echo e($centro->regionale?->Denominacion ?? 'N/A'); ?>

                        </td>

                        <td>
                            <div class="btn-group">

                                
                                <a href="<?php echo e(route('centros.show', $centro->NIS)); ?>"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                
                                <a href="<?php echo e(route('centros.edit', $centro->NIS)); ?>"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                
                                <form action="<?php echo e(route('centros.destroy', $centro->NIS)); ?>"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar este centro?');"
                                      style="display:inline">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            No hay centros registrados
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($centros->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($centros->links()); ?>

            </div>
        <?php endif; ?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/Centros/index.blade.php ENDPATH**/ ?>