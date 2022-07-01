
<form action="index.php?page=Mnt-buscador" method="post">
    <fieldset>
        <label for="filtrar">Filtrar por: </label>      
        <input type="radio" name="filtrar" id="filtrar" value="DSC" {{if isCheckedDsc}}checked{{endif isCheckedDsc}}> Descripción 
        <input type="radio" name="filtrar" id="filtrar" value="RNG" {{if isCheckedRng}}checked{{endif isCheckedRng}}> Rango 
        <input type="radio" name="filtrar" id="filtrar" value="DR" {{if isCheckedDR}}checked{{endif isCheckedDR}}> Ambos 
    </fieldset>
    <fieldset>
        <label for="filter">Buscar: </label>
        <input type="text" name="filter" id="filter" placeholder="Descripcion" value="{{desc}}">
    </fieldset>
    <fieldset>
        <label for="rangoMin">Precio minimo: </label>
        <input type="number" name="rangoMin" id="rangoMin" value="{{min}}">
    </fieldset>
    <fieldset>
        <label for="rangoMax">Precio maximo: </label>
        <input type="number" name="rangoMax" id="rangoMax" value="{{max}}">
    </fieldset>
    <fieldset>
        <button type="submit" name="btnBuscar">Buscar</button>
    </fieldset>
</form>

<section class="packages" id="packages">
            <h1 class="heading">
                Resultados:
            </h1>
        <div class="box-container">
            {{foreach Productos}}
            <div class="box">
                <img src="https://images.pexels.com/photos/4210617/pexels-photo-4210617.jpeg?cs=srgb&dl=pexels-karolina-grabowska-4210617.jpg&fm=jpg" alt="">
                <div class="content">
                    <h3> <i class="fas fa-map-marker-alt"></i>{{invPrdDsc}}</h3>
                    <p>{{invPrdTip}}</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="price">L. {{invPrdPrice}}</div>
                    <a href="#" class="btn">Detalle</a>
                </div>
            </div>
            {{endfor Productos}}
        </div>
        </section>
