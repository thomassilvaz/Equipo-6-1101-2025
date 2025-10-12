extends CharacterBody2D

func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

func play_animationplayer(anim_name: String):
	$AnimationPlayer.play(anim_name)

func _ready():
	match get_tree().current_scene.name:
		"piso2":
			if !Estados.decision2_tomada:
				global_position = Vector2(2016, -41)
			else:
				if Estados.decision_2 == "mala":
					decision2_mala()
				else:
					return

func decision2_mala():
	var tween = create_tween()
	tween.tween_property(self, "position", Vector2(1917, -41), 1.0)
