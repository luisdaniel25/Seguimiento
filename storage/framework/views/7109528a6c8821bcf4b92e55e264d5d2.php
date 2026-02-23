<?php $__env->startSection('title', 'Detalle Ficha de Caracterización'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Detalle de la Ficha</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">

        
        <div class="card-header">
            <h3 class="card-title">
                <?php echo e($fichadecaracterizacion->Denominacion); ?>

            </h3>
        </div>

        
        <div class="card-body">

            <p><strong>NIS:</strong> <?php echo e($fichadecaracterizacion->NIS); ?></p>

            <p><strong>Código:</strong>
                <?php echo e($fichadecaracterizacion->Codigo); ?>

            </p>

            <p><strong>Denominación:</strong>
                <?php echo e($fichadecaracterizacion->Denominacion); ?>

            </p>

            <p><strong>Cupo:</strong>
                <?php echo e($fichadecaracterizacion->Cupo); ?>

            </p>

            
            <p>
                <strong>Fecha Inicio:</strong>
                <?php echo e($fichadecaracterizacion->FechaInicio
                    ? \Carbon\Carbon::parse($fichadecaracterizacion->FechaInicio)->format('d-m-Y')
                    : 'N/A'); ?>

            </p>

            <p>
                <strong>Fecha Fin:</strong>
                <?php echo e($fichadecaracterizacion->FechaFin
                    ? \Carbon\Carbon::parse($fichadecaracterizacion->FechaFin)->format('d-m-Y')
                    : 'N/A'); ?>

            </p>

            <hr>

            <p><strong>Observaciones:</strong>
                <?php echo e($fichadecaracterizacion->Observaciones ?? 'N/A'); ?>

            </p>

            <hr>

            <p><strong>Fecha de Creación:</strong>
                <?php echo e($fichadecaracterizacion->created_at ? $fichadecaracterizacion->created_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>

            <p><strong>Última Actualización:</strong>
                <?php echo e($fichadecaracterizacion->updated_at ? $fichadecaracterizacion->updated_at->format('d-m-Y H:i:s') : 'N/A'); ?>

            </p>

        </div>

        


        <div class="card-footer">
            <a href="<?php echo e(route('Fichas.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="<?php echo e(route('Fichas.edit', $fichadecaracterizacion)); ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\resources\views/Fichas/show.blade.php ENDPATH**/ ?>