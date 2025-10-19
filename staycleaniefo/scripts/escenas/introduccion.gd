extends Node

func _on_area_2d_body_entered(body: Node2D) -> void:
	if body is Jugador and Estados.introduccion == true:
		EfectoTransicion.transition()
		await EfectoTransicion.on_transition_finished
		Estados.introduccion = true
		get_tree().change_scene_to_file("res://escenas/lugares/salon_principal.tscn")
