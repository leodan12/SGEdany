<div>
  ¿Desea eliminar a {{$colaborador->col_nombres}}, {{$colaborador->col_apellidos}}? 
</div> 
<button type="submit" class="btn btn-primary" ><a href="{{route('colaborador.delete',$colaborador->col_id)}}">SI</a></button>
<button type="submit" class="btn btn-primary"><a href="{{route('colaborador.register')}}">NO</a></button>