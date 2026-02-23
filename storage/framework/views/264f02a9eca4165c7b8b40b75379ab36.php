<?php $__env->startSection('title', 'Detalle Programa de Formación'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle del Programa de Formación</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">

        
        <div class="card-header">
            <h3 class="card-title">
                <?php echo e($programa->Denominacion); ?>

            </h3>
        </div>

        
        <div class="card-body">

            <p><strong>NIS:</strong> <?php echo e($programa->NIS); ?></p>
            <p><strong>Código:</strong> <?php echo e($programa->Codigo); ?></p>
            <p><strong>Denominación:</strong> <?php echo e($programa->Denominacion); ?></p>
            <p><strong>Observaciones:</strong> <?php echo e($programa->Observaciones ?? 'N/A'); ?></p>

            <hr>

            
            <p><strong>Ficha de Caracterización:</strong>
                <?php if($programa->fichadecaracterizacion): ?>
                    Ficha #<?php echo e($programa->fichadecaracterizacion->NIS); ?>

                    <br>
                    <small>Denominación: <?php echo e($programa->fichadecaracterizacion->Denominacion); ?></small>
                    <br>
                    <small>Cupo: <?php echo e($programa->fichadecaracterizacion->Cupo); ?></small>
                <?php else: ?>
                    <span class="badge badge-danger">N/A</span>
                <?php endif; ?>
            </p>

            
            <p><strong>Aprendices Asignados:</strong>
                <?php if($programa->aprendices && $programa->aprendices->count() > 0): ?>
                    <ul>
                        <?php $__currentLoopData = $programa->aprendices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aprendiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($aprendiz->Nombres); ?> <?php echo e($aprendiz->Apellidos); ?> (Documento: <?php echo e($aprendiz->NumDoc); ?>)
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <span class="badge badge-danger">No hay aprendices asignados</span>
                <?php endif; ?>
            </p>

            <hr>
            <p><strong>Fecha de Creación:</strong>
                <?php echo e($programa->created_at ? $programa->created_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>
            <p><strong>Última Actualización:</strong>
                <?php echo e($programa->updated_at ? $programa->updated_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>

        </div>

        
        <div class="card-footer">
            <a href="<?php echo e(route('programas.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="<?php echo e(route('programas.edit', $programa->NIS)); ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/programas/show.blade.php ENDPATH**/ ?>