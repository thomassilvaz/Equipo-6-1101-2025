extends PointLight2D

func _ready() -> void:
	parpadeo()

func parpadeo():
	var tween = create_tween()
	tween.tween_property(self, "texture_scale",3.0, 1.0)
	tween.tween_property(self, "texture_scale", 1.5, 1.0)
	tween.set_loops(0)
	
	#var tween = create_tween()
	#tween.tween_property(self, "color", Color("#7e7e7e"), 1.0)
	#tween.tween_property(self, "color", Color("#1d1d1d"), 1.0)
	#tween.set_loops(0)
