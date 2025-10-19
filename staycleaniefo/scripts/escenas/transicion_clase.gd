extends Control

func _ready() -> void:
	if get_tree().current_scene.name == "piso2" and Estados.decision3_tomada:
		if Estados.sustancia1 or Estados.charla_con_valeria:
			hide()
		else:
			show()
			await get_tree().create_timer(2.0).timeout
			var tween = create_tween()
			tween.tween_property(self, "modulate", Color.TRANSPARENT, 2.0)
			await tween.finished
			queue_free()
	else:
		hide()
