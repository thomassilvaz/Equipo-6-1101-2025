extends CollisionShape2D

@onready var player = get_parent().get_parent().get_parent().get_node("AnimationPlayer")

func _physics_process(_delta: float) -> void:
	if Estados.psicologia:
		set_physics_process(false)
		if !player.is_playing:
			player.play()
		await player.animation_finished
		EfectoTransicion.transition()
		await EfectoTransicion.on_transition_finished
		if Estados.escuela_oscura == 0 or Estados.escuela_oscura == 1:
			get_tree().call_deferred("change_scene_to_file", "res://escenas/final_bueno.tscn")
		elif Estados.escuela_oscura == 2:
			if Estados.contador == -9:
				get_tree().call_deferred("change_scene_to_file", "res://escenas/lugares/arena.tscn")
			else:
				get_tree().call_deferred("change_scene_to_file", "res://escenas/final_malo.tscn")
