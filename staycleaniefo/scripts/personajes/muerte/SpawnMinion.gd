extends State

@export var minion_node : PackedScene
var can_transition: bool = false

#accede la funcion de entrar en estado desde el script extendido
func enter():
	super.enter()
	animation_player.play("summon") #activa la animacion de invocacion
	await animation_player.animation_finished
	can_transition = true #ya puede salir del estado


func spawn():
	var spawn_count = randi() % 3 + 1 #invoca un numero de enemigos aleatorio
	for i in range(spawn_count):
		var minion = minion_node.instantiate()
		minion.position = owner.position + Vector2(150, -150) #se ubican en una ubicacion relativa al boss
		get_tree().current_scene.add_child(minion)
		
		if i < spawn_count - 1:
			await get_tree().create_timer(1.0).timeout #espera un tiempo para volver a invocar y repetirse
 
#cambia de estado y se asegura de que no se cambie solo
func transition():
	if can_transition:
		get_parent().change_state("Follow")
		can_transition = false
