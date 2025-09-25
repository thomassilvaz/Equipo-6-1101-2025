extends Node

const escena_entrada = preload("res://escenas/lugares/porteria.tscn")
const escena_piso1 = preload("res://escenas/lugares/piso_1.tscn")
const escena_salon2_p1 = preload("res://escenas/lugares/salon2_p1.tscn")

const escena_piso2 = preload("res://escenas/lugares/piso_2.tscn")
const escena_salon_principal = preload("res://escenas/lugares/salon_principal.tscn")

const escena_bath1 = preload("res://escenas/lugares/bathroom1.tscn")
const escena_bath2 = preload("res://escenas/lugares/bathroom2.tscn")

signal on_trigger_player_spawn
var spawn_puerta_tag

func go_to_level(nivel_tag, destino_tag):
	var escena_a_cargar
	
	match nivel_tag:
		"porteria":
			escena_a_cargar = escena_entrada
		"piso_1":
			escena_a_cargar = escena_piso1
		"piso_2":
			escena_a_cargar = escena_piso2
		"salon_principal":
			escena_a_cargar = escena_salon_principal
		"bathroom1":
			escena_a_cargar = escena_bath1
		"bathroom2":
			escena_a_cargar = escena_bath2
		"salon2_p1":
			escena_a_cargar = escena_salon2_p1
	if escena_a_cargar != null:
		EfectoTransicion.transition()
		await EfectoTransicion.on_transition_finished
		spawn_puerta_tag = destino_tag
		get_tree().call_deferred("change_scene_to_packed", escena_a_cargar)

func trigger_player_spawn(posicion: Vector2, direccion: String):
	on_trigger_player_spawn.emit(posicion, direccion)
