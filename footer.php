

<footer class="footer mt-auto py-3 bg-body-tertiary">
  <div class="container">
    <span class="text-body-secondary">Coopyright @2023 | Gestion des Projets </span>
  </div>
</footer>

<script type="text/javascript">
        $(document).ready( function () 
        {
            $("#datatable").dataTable
            (
              {
                  "oLanguage": 
                  {
                  /*"sLengthMenu": "Afficher MENU Enregistrements",*/
                  "sSearch": "Rechercher:",
                  "sInfo":"Total de TOTAL enregistrements (_END_ / _TOTAL_)",
                  "oPaginate":
                    {
                      "sfirst": "Premier",
                      "slast": "Dernier",
                      "sNext": "Suivant",
                      "sPrevious":"Précédent"
                    }
                   
                  }
              }
        )
      }
      );
  </script>

<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

      
  </body>
</html>

