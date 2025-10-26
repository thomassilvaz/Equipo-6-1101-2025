extends Area2D

#desvanece el arbol al entrar a su area
func _on_body_entered(body: Node2D) -> void:
	if body is Jugador:
		var sprite = get_parent().get_node("Sprite2D")
		var tween = create_tween()
		tween.tween_property(sprite, "modulate:a", 0.5, 0.3)

#lo materializa nuevamente al salir de esta
func _on_body_exited(body: Node2D) -> void:
	if body is Jugador:
		var sprite = get_parent().get_node("Sprite2D")
		var tween = create_tween()
		tween.tween_property(sprite, "modulate:a", 1.0, 0.3)
