extends State

#se encarga de que los estados posibles sean aleatorios
func _enter_tree():
	randomize()
 
#accede la funcion de entrar en estado desde el script extendido
func enter():
	super.enter()
	owner.set_physics_process(true)
	animation_player.play("idle")

#accede la funcion de salir de estado desde el script extendido y se deja de mover el boss
func exit():
	super.exit()
	owner.set_physics_process(false)

#canbia a un estado determinado segun la distancia del jugador
func transition():
	if owner.direction.length() <= 120:
		get_parent().change_state("Attack")
	if owner.direction.length() > 300:
		var chance = randi() % 2
		match chance:
			0:
				get_parent().change_state("SpawnMinion")
			1:
				get_parent().change_state("Teleport")
