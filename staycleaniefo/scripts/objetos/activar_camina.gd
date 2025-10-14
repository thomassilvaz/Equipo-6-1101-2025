extends Area2D

func _on_body_entered(_body: Node2D) -> void:
	if !Estados.decision2_tomada:
		get_node("CollisionShape2D").set_deferred("disabled", true)
		get_parent().get_node("AnimationPlayer").play("camina1")
	else:
		return
