</div>

        <!-- upload files start -->
        <script src="../js/upload/jquery.knob.js"></script>
        <script src="../js/upload/jquery.ui.widget.js"></script>
        <script src="../js/upload/jquery.iframe-transport.js"></script>
        <script src="../js/upload/jquery.fileupload.js"></script>
        <script src="../js/upload/script.js"></script>
        <script type="text/javascript" src="../js/jquery.maskedinput-1.3.js"></script>
        <!-- upload files end -->

        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <!-- Page-Level Plugin Scripts - Blank -->
        <script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="../js/cidades-estados-1.4-utf8.js"></script>

        <script src="../js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="../js/plugins/colorpicker/docs.js"></script>
        <script type="text/javascript" src="../js/plugins/intro/intro.js"></script>
        
        <!-- UPLOAD FILES -->
        <script src="../js/angular.min.js"></script>
        <script src="../js/angular-file-upload.min.js"></script>
        <script src="../js/controllers.js"></script>
        <script src="../js/directives.js"></script>
        <script src="../js/bootstrap-filestyle.min.js"></script>

        <!-- Mint Admin Scripts - Include with every page -->
        <script src="../js/mint-admin.js"></script>
        <script src="../js/plugins/fancyselect/fancySelect.js"></script>
        <script type="text/javascript" src="../js/plugins/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('.date').mask('00/00/0000');
                $('.time').mask('00:00');
                $('.phone').mask('(00) 0000-0000');
                $('.money').mask("#.##0,00", {reverse: true});
                $('#dataTables-example').dataTable();
                $('#msg-sucesso').hide().show('slow').delay(1000).hide('slow');
                $(':file').filestyle({input: false});
                $('.fancybox').fancybox();
                $('.colorpick').colorpicker();
            });
        </script>
        

        <script type="text/javascript" charset="utf-8">
            new dgCidadesEstados({
            cidade: document.getElementById('cidade'),
            estado: document.getElementById('estado')
        });
        </script>

        <!-- TEXT EDITOR -->
        <script type="text/javascript" src="../js/froala/js/froala_editor.min.js"></script>
        <script type="text/javascript" src="../js/froala/js/plugins/table.min.js"></script>
        <script type="text/javascript" src="../js/froala/js/plugins/code_view.min.js"></script>
        <script src='../js/froala/js/languages/pt_br.js'></script>
        <script>
          $(function(){
           $('#add').froalaEditor({
               tableResizerOffset: 50,
               language: 'pt_br',
               height: 150,
               toolbarSticky: false,
               toolbarButtons: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'clearFormatting', 'insertTable', 'html'],
               toolbarButtonsXS: ['undo', 'redo' , '-', 'bold', 'italic', 'underline']
             })
           $('#edit').froalaEditor({
               tableResizerOffset: 50,
               language: 'pt_br',
               height: 150,
               toolbarSticky: false,
               toolbarButtons: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'clearFormatting', 'insertTable', 'html'],
               toolbarButtonsXS: ['undo', 'redo' , '-', 'bold', 'italic', 'underline']
             })
          });
        </script>


    </body>

</html>
