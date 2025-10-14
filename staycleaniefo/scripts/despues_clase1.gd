extends CollisionShape2D

func _ready():
	if Estados.decision3_tomada == true:
		set_deferred("disabled", false)
	else:
		set_deferred("disabled", true)

func cambiar_escena():
	EfectoTransicion.transition()
	await EfectoTransicion.on_transition_finished
	if Estados.decision_3 == "buena":
		get_tree().change_scene_to_file("res://escenas/lugares/salon2_p1.tscn")
	elif Estados.decision_3 == "mala":
		if Estados.nom == "Alex":
			get_tree().change_scene_to_file("res://escenas/lugares/bathroom1.tscn")
		elif Estados.nom == "Alexa":
			get_tree().change_scene_to_file("res://escenas/lugares/bathroom2.tscn")
