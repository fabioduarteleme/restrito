</div>

        <!-- upload files start -->
        <script src="../js/upload/jquery.knob.js"></script>
        <script src="../js/upload/jquery.ui.widget.js"></script>
        <script src="../js/upload/jquery.iframe-transport.js"></script>
        <script src="../js/upload/jquery.fileupload.js"></script>
        <script src="../js/upload/script.js"></script>
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
        <script src="http://code.angularjs.org/1.1.5/angular.min.js"></script>
        <script src="../js/angular-file-upload.min.js"></script>
        <script src="../js/controllers.js"></script>
        <script src="../js/directives.js"></script>
        <script src="../js/bootstrap-filestyle.min.js"></script>

        <!-- Mint Admin Scripts - Include with every page -->
        <script src="../js/mint-admin.js"></script>
        <script src="../js/plugins/maskmoney/jquery.mask.min.js"></script>
        <script src="../js/plugins/fancyselect/fancySelect.js"></script>
        <script type="text/javascript" src="../js/plugins/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('#dataTables-example').dataTable();
                $('#msg-sucesso').hide().show('slow').delay(1000).hide('slow');
                $(':file').filestyle({input: false});
                $('.maskreal').mask("#.##0,00", {reverse: true});
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
    </body>

</html>
