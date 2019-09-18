/**
 * Created by watermelon on 02/06/2015.
 */


(function (window, $, undefined) {
    "use strict";

    $.scannerdevice = function scannerdevice(options, element) {


        this.options		= $.extend(true, {}, $.scannerdevice.defaults, options, $(this.element).data());

        this.element		= element;
        var $window 		= $(window);
        var _self	 		= this;
        this.matching_card	= false;

        //buttons
        this.button				= {};

        this.button.scan        = '<div class="btn btn-success scan" ><i class="fa fa-wifi"></i> 配對</div>';
        this.button.rescan      = '<div class="btn btn-success rescan"><i class="fa fa-wifi"></i> 重新配對</div>';
        this.button.clear      = '<div class="btn btn-danger clear"> 清空</div>';
        this.button.cancelscan  = '<div class="btn btn-success" >取消</div>';

        this.modal              = '<div id="uidemo-modals-alerts-success" class="modal modal-alert modal-success fade">' +
                                    '<div class="modal-dialog">' +
                                        '<div class="modal-content">' +
                                            '<div class="modal-header">' +
                                                '<i class="fa fa-wifi"></i>' +
                                            '</div>' +
                                            '<div class="modal-title">請拍卡</div>' +
                                            '<div class="modal-body"><i class="fa fa-spinner fa-spin"> </i> 偵查中</div>' +
                                            '<div class="modal-footer cancelscan">'+
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                  '</div>';

        _self._init();
    }

    $.scannerdevice.defaults = {
        onAfterScan:	null,
        allowClear:     true,
        clearOnRescan:	false
    };

    $.scannerdevice.prototype = {

        _init: function() {

            var _self			= this;
            var options			= _self.options;
            var element			= _self.element;

            if (empty($(element))) {
                return false;
            }

            $(element).hide();

            var wrapper          = $('<div class="input-group"></div>');
            $(element).wrap(wrapper);

            $(element).before($(_self.button.scan).on({
                'click': function(e) {
                    _self.matching_card = true;
                    _self.startscan();
                }
            }));

            var tools = $('<span class="input-group-btn"></span>');

            if(_self.options.allowClear){

                $(_self.button.rescan).addClass("btn-secondary");
                $(tools).append($(_self.button.rescan).on({
                    'click': function(e) {
                        if (_self.options.clearOnRescan){
                            $(element).parent().find('input').val('');
                        }
                        _self.matching_card = true;
                        _self.startscan();
                    }
                }));
                $(_self.button.clear).addClass("btn-secondary");
                $(tools).append($(_self.button.clear).on({
                    'click': function(e) {
                        $(element).parent().find('input').val('');
                    }
                }));

            }else{

                $(tools).append($(_self.button.rescan).on({
                    'click': function(e) {
                        if (_self.options.clearOnRescan){
                            $(element).parent().find('input').val('');
                        }
                        _self.matching_card = true;
                        _self.startscan();
                    }
                }));
            }


            $(element).before(tools);

            $(element).parent().find('.rescan').hide();
            $(element).parent().find('.clear').hide();

            $(element).parent().append(_self.modal);
            $(element).parent().find('.cancelscan').append(_self.button.cancelscan).on('click', function(e){
                e.preventDefault();
                $(element).parent().find(".modal").modal("hide");
                _self.cancel_matchcard();
            });


        },
        startscan: function() {
            var _self			= this;
            var options			= _self.options;
            var element			= _self.element;

            $(element).parent().find(".modal").modal();

            //console.log($(element).parent());
            //$(element).parent().val("");

            $("body").scannerDetection({
                //preventDefault:true
            });

            $("body").bind('scannerDetectionComplete',function(e,data){
                if(_self.matching_card){
                    $(element).parent().find(".modal").modal("hide");
                    _self.matchcard(data);
                    if (_self.options.onAfterScan) _self.options.onAfterScan.call(_self,_self);
                }
            });


        },
        matchcard: function(data){
            var _self			= this;
            var options			= _self.options;
            var element			= _self.element;

            $(element).show();
            $(element).val(data.string);
            $(element).parent().find('.scan').hide();
            $(element).parent().find('.rescan').show();
            if(_self.options.allowClear){
                $(element).parent().find('.clear').show();
            }

            _self.cancel_matchcard();
        },
        cancel_matchcard: function(){
            var _self			= this;
            var options			= _self.options;
            var element			= _self.element;
            _self.matching_card =  false;

        },
        reset: function(){
            var _self			= this;
            var options			= _self.options;
            var element			= _self.element;
            _self.matching_card =  false;

            $(element).hide();
            $(element).val('');
            $(element).parent().find('.scan').show();
            $(element).parent().find('.rescan').hide();

        }
    }

    $.fn.scannerdevice = function (options) {
        if ($.data(this, "scannerdevice")) return;
        return $(this).each(function() {
            new $.scannerdevice(options, this);
            $.data(this, "scannerdevice");
        })
    }

})(window, jQuery);


function empty(mixed_var) {
    //discuss at: http://phpjs.org/functions/empty/
    // original by: Philippe Baumann
    //    input by: Onno Marsman
    //    input by: LH
    //    input by: Stoyan Kyosev (http://www.svest.org/)
    // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Onno Marsman
    // improved by: Francesco
    // improved by: Marc Jansen
    // improved by: Rafal Kukawski

    var undef, key, i, len;
    var emptyValues = [undef, null, false, 0, '', '0'];

    for (i = 0, len = emptyValues.length; i < len; i++) {
        if (mixed_var === emptyValues[i]) {
            return true;
        }
    }

    if (typeof mixed_var === 'object') {
        for (key in mixed_var) {
            return false;
        }
        return true;
    }
    return false;
}







