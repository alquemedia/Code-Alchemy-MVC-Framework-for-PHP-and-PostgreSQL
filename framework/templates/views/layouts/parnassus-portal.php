<?php

// Get Controller
$controller = get_controller( $this );

$webroot = \Code_Alchemy\Core\Code_Alchemy_Framework::instance()->webroot();

// Get State
$state = $controller->state();

$data = $controller->data();

$action = $controller->uri()->part(2);

$model = $controller->uri()->part(3);

$model_id = $controller->uri()->part(4);

$commmand = $controller->uri()->part(5);

$services = $data['services'];

$service_types = $data['service_types'];

FB::log($service_types);

?>
<!DOCTYPE html>
<html>
<head>
    <?php
        require_once( $webroot."/app/views/components/parnassus-portal-head.php");
    ?>
</head>
<body>

<?php
require_once( $webroot."/app/views/components/parnassus-portal-nav.php");
?>

<div style="margin-top: 50px;" class="container">
    <div class="bs-docs-section clearfix" style="margin-top: 50px">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="admin-title"></h2>
            </div>
        </div>
        <div class="row managed-services">
            <div class="col-lg-12 ">
                <!-- Dashboard controls -->
                <div class="btn-group">
                    <!--
                    <a class="btn btn-primary" href="#">Primary</a>
                    <a data-toggle="dropdown" class="btn btn-primary dropdown-toggle" href="#" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                    -->
                    <select id="new_service_type" style="color: black;margin-left: 10px;" class="pull-left">
                        <?php foreach ( $service_types as $label => $type ){?>
                        <option value="<?=$type?>"><?=$label?></option>
                        <?php } ?>
                    </select>
                    <input id="new_service_name" placeholder="Name of new service" style="margin-left: 10px;" class="pull-left"/>
                    <a style="margin-left: 10px;" class="btn btn-success add-service" href="#">
                        <i class="fa fa-plus-circle"></i>
                        &nbsp; Add
                    </a>
                </div>
                <!-- End Dashboard Controls -->
                <div class="checkbox">
                    <label>
                        <input class="show-hidden" type="checkbox"> Show hidden services
                    </label>
                </div>
            </div>

            <div class="col-lg-4 left-panel">
            </div>
            <div class="col-lg-4 middle-panel">
            </div>
            <div class="col-lg-4 right-panel">
            </div>
        </div>
    </div>
    <?php

    require_once $webroot."/app/views/components/parnassus-portal-footer.php";
    ?>
</div>

    <script>
        $(function(){

            // Add a new service
            $('.add-service').on('click',function(e){

                e=e?e:window.event;

                e.preventDefault();

                var data = 'type='+$('#new_service_type').val()+'&name='+$('#new_service_name').val();

                console.log(data);

                $.ajax({
                    url: '/parnassus/new_service',
                    type: 'POST',
                    data: data,
                    success: function(json){

                        if ( json.result =='success')

                            window.location.reload();
                    }
                });

                return false;
            });

            // Edit a service label
            $('.managed-services').on('keyup','input.edit-service-label',function(e){

                console.log ('event');
                e=e?e:window.event;

                var input = $(e.currentTarget);

                var key = e.which? e.which: e.keyCode;

                var value = input.val();

                var service_name = input.attr('data-service-name');

                if ( key == 13 && value.length )

                    $.ajax({

                        type: 'POST',

                        url: '/parnassus/set_service_label_for/'+service_name,

                        data: 'label='+value,

                        success: function(json){

                            input.hide();

                            $('h3[data-service-name="'+service_name+'"]').show().find('.label-name-span').html(json.service_label);

                            input.parent().show();
                        }
                    })
            });

            // show/hide hidden services
            $('input.show-hidden').on('change',function(e){

                var is_checked = $(this).is(':checked');

                var $div = $('div.hidden-service');

                if ( is_checked )

                    {

                        $div.fadeIn('slow');
                    }

                else

                    $div.fadeOut('fast');
            });



            $.ajax({

                url: '/parnassus_portal/fetch_data',
                success: function(data){

                    //console.log(data);

                    var position = '.left-panel';

                    var menu = $('.models-menu');

                    // For each returned Item
                    $.each(data,function(index,item){

                        $(position).append('<div style="text-decoration:'+
                            (item.is_hidden? 'line-through':'none')+
                            ' ;display:'+(item.is_hidden?'none':'')+
                            '" class="'+(item.is_hidden?'hidden-service':'')+
                            ' panel panel-primary"><div class="panel-heading"><input data-service-name="'+item.table_name+'" class="edit-service-label" style="display:none;" value="'+item.service_label+
                            '"/><h3 data-service-name="'+item.table_name+'" class="panel-title"><span class="label-name-span">'+item.service_label+'</span>'+
                            '<i style="cursor: pointer" class="fa fa-pencil pull-right edit-service" data-service-name="'+item.table_name+
                            '"></i><i style="cursor:pointer" class="'+(item.is_hidden?'is-hidden':'')+' pull-right fa '+(item.is_hidden?'fa-eye':'fa-times')+' remove-service" data-service-name="'+item.table_name+'"></i></h3></div><div class="panel-body"><a href="/parnassus/list_of/'+item.table_name+'">Click to manage: <span class="badge">'+item.count_models+'</span></a></div></div>');

                        position = (position=='.left-panel')?'.middle-panel':
                            ((position=='.middle-panel')?'.right-panel':'.left-panel');

                        // Add Menu Item
                       // menu.append('<li><a href="/parnassus/list_of/'+item.table_name+'">'+item.service_label+'</a></li>');

                    });

                    // Remove a service,which just means hide it
                    $('.remove-service').on('click',function(e){

                        var is_hidden = !! $(this).hasClass('is-hidden');

                        var control = $(this);

                        // Remove via Ajax
                        $.ajax({

                            url: '/parnassus/hide_service',
                            type:'POST',
                            data: 'service='+control.attr('data-service-name'),
                            success: function(json){

                                if ( json.result == 'success')

                                    window.location.reload();

                            }
                        });

                    });

                    // Edit a Service
                    $('.edit-service').on('click',function(e){

                        var control = $(this);

                        var service = control.attr('data-service-name');

                        control.parent().hide();

                        control.parent().parent().find('input').show();
                    });
                }
            });
        });
    </script>
</body>
</html>

<?php

/**
 * Local function to normalize Controller, for code completion
 * @param \_mynamespace_\controllers\app_controller $controller
 * @return \_mynamespace_\controllers\app_controller controller
 */
function get_controller( \_mynamespace_\controllers\app_controller $controller ){

    return $controller;
}
?>