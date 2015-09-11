</div>

        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="js/cidades-estados-1.4-utf8.js"></script>
        <script src="js/bootstrap-filestyle.min.js"></script>
        <script src="js/mint-admin.js"></script>
        <script src="js/plugins/maskmoney/jquery.mask.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('.maskreal').mask("#.##0,00", {reverse: true});
                $('.cpf').mask('000.000.000-00', {reverse: true});
                $('.telefone').mask('(00)0000-0000');
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