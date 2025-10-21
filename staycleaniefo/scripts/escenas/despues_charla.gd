extends CollisionShape2D

func _ready() -> void:
	if Estados.charla_con_valeria:
		set_deferred("disabled", false)
	else:
		set_deferred("disabled", true)

#func _on_body_entered(body: Node2D) -> void:
	#if body is Jugador:
		#if Estados.charla_con_valeria:
			#if !Estados.despues_charla:
				#var animacion = get_parent().get_parent().get_node("AnimationPlayer")
				#animacion.play("despues_de_charla")
				#await animacion.animation_finished
				#queue_free()
			#else:
				#queue_free()
		#else:
			#print("No hay cita")
