extends Area2D

#activa la animacion que termina la clase y cambia la escena posteriormente
func _on_body_entered(body: Node2D) -> void:
	if body is Jugador:
		if Estados.empezar_primera_clase and !Estados.primera_clase_hecha:
			var animacion = get_parent().get_parent().get_node("AnimationPlayer")
			animacion.play("terminar_clase1")
			print("Puede empezar la clase")
			await animacion.animation_finished
			print("Termino la clase!")
			EfectoTransicion.transition()
			await EfectoTransicion.on_transition_finished
			Estados.primera_clase_hecha = true
			get_tree().call_deferred("change_scene_to_file", "res://escenas/lugares/piso_2.tscn")
		else:
			print("No hay clase")
			return
