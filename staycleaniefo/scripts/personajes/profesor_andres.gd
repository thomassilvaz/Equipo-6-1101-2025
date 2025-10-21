extends CharacterBody2D

func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

func play_animationplayer(anim_name: String):
	$AnimationPlayer.play(anim_name)

func _ready():
	match get_tree().current_scene.name:
		"piso1":
			if Estados.decision3_tomada:
				global_position = Vector2(-489, 1010)
			else:
				global_position = Vector2(-128, -519)
		"salonprincipal":
			if Estados.charla_con_valeria:
				global_position = Vector2(-389, -8)
			else:
				global_position = Vector2(524, -514)
