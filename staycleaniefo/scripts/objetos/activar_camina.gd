extends Area2D

func _on_body_entered(_body: Node2D) -> void:
	if !Estados.caminarconmateo1:
		get_node("CollisionShape2D").set_deferred("disabled", true)
		get_parent().get_node("AnimationPlayer").play("camina1")
		Estados.caminarconmateo1 = true
	else:
		return
