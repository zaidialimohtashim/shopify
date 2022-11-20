$(function(){

var DesignerLib = {

    init:function(){
        this.toolBoxDrag();
        this.changeImageColor();
        this.widgets();
        this.addBadgesAndStickers();
        this.selectObject();
        this.deleteObject();
        this.TextColorChange();
        this.addText();
        this.TextFontSize();
        this.TextFontFamily();
        this.fontStyle();
        this.save();
    },
    saveCustomizeProduct:function(img){
        $.ajax({
            url:'/save_customize_product',
            type:'post',
            data:{image:img,_token:$('input[name="_token"]').val(),product_id:product_ids,shop_id:shop_ids},
            success:function(){

            }
        })
    },
    save:function(){
        $("#save").on("click",function(){
            var node = document.getElementById('stage');
                domtoimage.toPng(node)
                    .then(function (dataUrl) {
                        console.log(dataUrl);
                        DesignerLib.saveCustomizeProduct(dataUrl)
                        
                        // var img = new Image();
                        // img.src = dataUrl;
                        // document.body.appendChild(img);
                    })
                    .catch(function (error) {
                        console.error('oops, something went wrong!', error);
                    });
        })
    },
    toolBoxDrag:function(){
        $("#toolbox").draggable({
            handle: "#move",
            containment: ".designer"
        });
    },
    changeImageColor:function(){
         const bg = document.getElementById('bg');
    },
    hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
          r: parseInt(result[1], 16),
          g: parseInt(result[2], 16),
          b: parseInt(result[3], 16)
        } : null;
    },
    randomColor:function(){
        return  Math.floor(Math.random() * 255);
    },
    widgets:function(){
        $(".badges label").on('click',function(){
            $(this).next().slideToggle();
        });  
    },
    addBadgesAndStickers:function(){
        $(".colapse li span.image").on('click',function(){
            var image = $(this).find("img").attr("src");
            var objectId = DesignerLib.objectIdentity();
            var element = '<div class="d_and_d" data-type="sticker_and_badge" data-id="'+ objectId +'"><img src="'+ image +'"/>'
            + '<div class="ui-resizable-handle ui-resizable-nw" id="nwgrip"></div>'
            + '</div>'; 
            $("#stage").append(element);

            $('div[data-id="'+ objectId +'"]').draggable();
            $('div[data-id="'+ objectId +'"]').css({'top':'1px'});
            $('div[data-id="'+ objectId +'"]').resizable({ 
                handles: {
                    'nw': '#nwgrip'
                }
            });

            $('div[data-id="'+ objectId +'"]').click();
            DesignerLib.enableSave();

        });
    },
    enableSave:function(){
        if($(".d_and_d").length > 0){
            $(".save_icon").removeClass('disabled_mode');
        }else{
            $(".save_icon").addClass('disabled_mode');
        }
    },
    addText:function(){
        $("#add_text").on("click",function(){
            var image = $(this).find("img").attr("src");
            var objectId = DesignerLib.objectIdentity();
            var element = '<div class="d_and_d" data-type="text" data-id="'+ objectId +'"><div class="text_content" contentEditable="true"></div>'
            + '<div class="ui-resizable-handle ui-resizable-nw" id="nwgrip"></div>'
            + '</div>'; 
            $("#stage").append(element);

            $('div[data-id="'+ objectId +'"]').draggable({cancel: '.text_content'});
            // $('div[data-id="'+ objectId +'"]').find(".text_content").attr('contenteditable','true');
            $('div[data-id="'+ objectId +'"]').css({'top':'25%'});
            $('div[data-id="'+ objectId +'"]').resizable({ 
                handles: {
                    'nw': '#nwgrip'
                }
            });
            
            $('div[data-id="'+ objectId +'"]').click();
            DesignerLib.enableSave();
        })
    },
    TextColorChange:function(){
        $(document).on("change" , "#color" , function(){
            $('div[data-id="'+ sessionStorage.obj_id +'"]').find(".text_content").css({'color':$(this).val()})
        });
    },
    TextFontSize:function(){
        $(document).on("change" , "#font_size" , function(){
            $('div[data-id="'+ sessionStorage.obj_id +'"]').find(".text_content").css({'font-size':$(this).val()})
        });
    },
    TextFontFamily:function(){
        $(document).on("change" , "#font_family" , function(){
            $('div[data-id="'+ sessionStorage.obj_id +'"]').find(".text_content").css({'font-family':$(this).val()})
        });
    },
    fontStyle:function(){
        $(document).on("click" , "#do_bold" , function(){
            $(this).toggleClass("active");
            $('div[data-id="'+ sessionStorage.obj_id +'"]').find(".text_content").toggleClass('bold');
        });

        $(document).on("click" , "#do_underline" , function(){
            $(this).toggleClass("active");
            $('div[data-id="'+ sessionStorage.obj_id +'"]').find(".text_content").toggleClass('underline');
        });

        $(document).on("click" , "#do_italic" , function(){
            $(this).toggleClass("active");
            $('div[data-id="'+ sessionStorage.obj_id +'"]').find(".text_content").toggleClass('italic');
        });
    },
    selectObject:function(){
        $("#stage").on('click','.d_and_d',function(){
            $(".d_and_d").find(".ui-resizable-handle").hide();
            $(this).find(".ui-resizable-handle").show();

            if($(this).attr('data-type')=="text"){
                $(this).find(".text_content").css({border:'1px solid #fff'});
            }
            sessionStorage.obj_id = $(this).attr('data-id')
        });

        $(document).mouseup(function(e) 
            {
                var container = $(".d_and_d");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) 
                {
                    container.find(".ui-resizable-handle").hide();
                    if(container.attr('data-type')=="text"){
                        container.find(".text_content").css({border:'none'});
                    }
                }
            });
    },
    deleteObject:function(){
        $(document).on('keyup',function(e){
            // if key is Delete
            if(e.which == 46){
              // remove the same div you clicked on
              $('div[data-id="'+ sessionStorage.obj_id +'"]').remove();
              
              if($(".d_and_d").length > 0){
                $(".save_icon").removeClass('disabled_mode');
                }else{
                    $(".save_icon").addClass('disabled_mode');
                }
              // to remove the parent
              //$('div.ToDelete').parent().remove();
            }
          });
    },
    objectIdentity:function(){
        return Math.floor(new Date().valueOf() * Math.random()) ;
    }
};

DesignerLib.init();

})