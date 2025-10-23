extends AnimatedSprite2D

func play_animation(anim_name: String):
	play(anim_name)

func fade_in():
	var tween = create_tween()
	tween.tween_property(self, "modulate:a", 1.0, 2.0)

func fade_out():
	var tween = create_tween()
	tween.tween_property(self, "modulate:a", 0.0, 2.0)
