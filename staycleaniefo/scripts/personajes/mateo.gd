extends CharacterBody2D

@onready var colision = $CollisionShape2D
@onready var interactuable = $Interactuable/CollisionShape2D

func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

func play_animationplayer(anim_name: String):
	$AnimationPlayer.play(anim_name)

func _ready():
	match get_tree().current_scene.name:
		"piso1":
			if Estados.decision3_tomada:
				if Estados.charla_con_valeria:
					if Estados.caminar_cafeteria:
						global_position = Vector2(-379, 892)
					else:
						global_position = Vector2(401, 0)
				else:
					global_position = Vector2(-128, -519)
			else:
				global_position = Vector2(-128, -519)
		"piso2":
			if Estados.decision3_tomada:
				if !Estados.charla_con_valeria:
					if Estados.sustancia1:
						global_position = Vector2(798, -55)
						interactuable.get_parent().dialogue_start = "sustancia1"
					else:
						global_position = Vector2(2424, -29)
				else:
					global_position = Vector2(154, -723)
			else:
				global_position = Vector2(798, -55)
		"salon2_p1":
			if Estados.decision3_tomada:
				if Estados.decision_3 == "buena":
					if Estados.charla_con_valeria:
						global_position = Vector2(154, -323)
					else:
						global_position = Vector2(389, 81)
				else:
					global_position = Vector2(154, -323)
			else:
				global_position = Vector2(154, -323)

func visibilidad_npc(visibilidad: bool):
	if visibilidad:
		show()
		colision.disabled = false
		interactuable.disabled = false
	else:
		hide()
		colision.disabled = true
		interactuable.disabled = true
