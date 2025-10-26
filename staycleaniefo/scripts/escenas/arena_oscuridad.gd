extends PointLight2D

func _ready() -> void:
	parpadeo()

#efecto estetico que parpadea la luz del jugador en el boss
func parpadeo():
	var tween = create_tween()
	tween.tween_property(self, "texture_scale",3.0, 1.0)
	tween.tween_property(self, "texture_scale", 1.5, 1.0)
	tween.set_loops(0)
