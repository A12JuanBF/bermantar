
<div class="container">
    <div   class="row">
        <div id="post_it" class="col-lg-5 col-md-8 col-sm-8 col-xs-10">
            <h4>Deja una nota <span class="glyphicon glyphicon-pencil"></span></h4>
            <div >
                <form role="form">
                    <div>
                        <div class=" form-group row col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <label  class="control-label">Asunto</label>
                            <input type="text" />
                        </div>
                        <div class="form-group row col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <label  class="control-label">Texto</label>
                            <textarea class="form-control" ></textarea>
                        </div>
                    </div>    
                        <div class="form-group row col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <input class="btn btn-default" type="reset" value="Cancelar"/>
                            <input class="btn btn-primary" type="submit" value="Enviar"/>
                        </div>
                    
                </form>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <?php
            $vista->tablonPostit();
            ?>
        </div>




    </div>

</div>
