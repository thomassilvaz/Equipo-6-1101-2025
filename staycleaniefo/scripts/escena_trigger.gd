extends Area2D

@export var cutscene_controller_path: NodePath

func _on_body_entered(body: Node2D) -> void:
	if body is Jugador:
		var cutscene_controller = get_node(cutscene_controller_path)
		if cutscene_controller and cutscene_controller.has_method("start_cutscene"):
			cutscene_controller.start_cutscene()
			set_deferred("monitoring", false)
		else:
			push_error("Cutscene controller not found or missing start_cutscene method")
