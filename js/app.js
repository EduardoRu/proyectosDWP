// Generar una vista del modal a partide ciertos parametros
 form = '<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> \
     <div class="modal-content"> \
         <div class="modal-header"> \
             <h2 class="modal-title fs-5" id="exampleModalLabel">Agrega un nuevo proyecto</h2> \
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> \
         </div> \
         <div class="modal-body"> \
             <form method="post" name="userData" id="userData" enctype="multipart/form-data"> \
                 <div class="form-group"> \
                     <label for="nombre_pro">Nombre del proyecto</label> \
                     <input type="text" name="nombre_pro" id="nombre_pro" class="form-control" required> \
                 </div> \
                 <div class="form-group"> \
                     <label for="desc">Descripción del proyecto</label> \
                     <textarea type="text" name="desc" id="desc" class="form-control" required> </textarea> \
                 </div> \
                 <div class="form-group"> \
                     <label for="img_pro">Imagen del proyecto</label> \
                     <input type="file" name="img_pro" id="img_pro" class="form-control border border-0" accept="image/*" required> \
                 </div> \
                 <div class="form-group"> \
                     <label for="email">Email del creador</label> \
                     <input type="text" name="email" id="email" class="form-control" required> \
                 </div> \
                 <div class="form-group"> \
                     <label for="tel">telefono del creador</label>\
                     <input type="number" name="tel" id="tel" class="form-control" required>\
                 </div>\
                 <div style="display:flex;justify-content:center">\
                     <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>\
                     <input type="submit" name="submit_create" class="btn btn-primary" value="Guardar proyecto">\
                 </div>\
             </form>\
         </div>\
     </div>\
 </div>\
</div>'