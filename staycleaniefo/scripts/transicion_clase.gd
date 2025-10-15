extends Control

func _ready() -> void:
	if get_tree().current_scene.name == "piso2" and Estados.decision3_tomada:
		show()
		await get_tree().create_timer(2.0).timeout
		create_tween().tween_property(self, "modulate", 0, 0)
		queue_free()
	else:
		hide()
		
		
		#if Estados.escuela_oscura:
		#create_tween().tween_property(self, "modulate", Color("#c4d9e4"), 1.0)
	#else:
		#create_tween().tween_property(self, "modulate", Color("#ffffff"), 1.0)
		
			#if body is Jugador:
		#var sprite = get_parent().get_node("Sprite2D")
		#var tween = create_tween()
		#tween.tween_property(sprite, "modulate:a", 0.5, 0.3)
#
#
#func _on_body_exited(body: Node2D) -> void:
	#if body is Jugador:
		#var sprite = get_parent().get_node("Sprite2D")
		#var tween = create_tween()
		#tween.tween_property(sprite, "modulate:a", 1.0, 0.3)
