extends CollisionShape2D

@onready var player = get_parent().get_parent().get_parent().get_node("AnimationPlayer")

func _physics_process(_delta: float) -> void:
	#activa la escena de la psicologa y se desactiva para no repetirse
	if Estados.psicologia:
		set_physics_process(false)
		if !player.is_playing:
			player.play()
		await player.animation_finished
		EfectoTransicion.transition()
		await EfectoTransicion.on_transition_finished
		
		#teletransporta al jugador segun su reputacion y sustancias consumidas
		if Estados.escuela_oscura == 1:
			get_tree().call_deferred("change_scene_to_file", "res://escenas/finales/final_neutral.tscn")
		elif Estados.escuela_oscura == 0:
			get_tree().call_deferred("change_scene_to_file", "res://escenas/finales/final_bueno.tscn")
		elif Estados.escuela_oscura == 2:
			if Estados.contador == -9:
				get_tree().call_deferred("change_scene_to_file", "res://escenas/transicion_boss.tscn")
			else:
				get_tree().call_deferred("change_scene_to_file", "res://escenas/finales/final_malo.tscn")
