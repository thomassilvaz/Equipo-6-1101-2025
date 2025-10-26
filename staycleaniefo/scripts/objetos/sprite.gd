extends AnimatedSprite2D

#funcion llamada para mostrar una animacion de manera explicita
func play_animation(anim_name: String):
	play(anim_name)

#funcion que hace aparecer gradualmente el nodo sprite
func fade_in():
	var tween = create_tween()
	tween.tween_property(self, "modulate:a", 1.0, 2.0)

#lo desvanece
func fade_out():
	var tween = create_tween()
	tween.tween_property(self, "modulate:a", 0.0, 2.0)
