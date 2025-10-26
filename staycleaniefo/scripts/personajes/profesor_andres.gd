extends CharacterBody2D

#funcion que al llamarse activa una animacion del sprite manualmente
func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

#funcion que al llamarse activa una animacion de su animationplayer
func play_animationplayer(anim_name: String):
	$AnimationPlayer.play(anim_name)

#determina la posicion del personaje segun la escena y las condiciones activas
func _ready():
	match get_tree().current_scene.name:
		"piso1":
			if Estados.decision3_tomada:
				global_position = Vector2(-489, 1010)
			else:
				global_position = Vector2(-128, -519)
		"salonprincipal":
			if Estados.charla_con_valeria or Estados.sustancia1:
				global_position = Vector2(-389, -8)
			else:
				global_position = Vector2(524, -514)
