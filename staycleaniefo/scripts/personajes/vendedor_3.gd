extends CharacterBody2D

@onready var interactuable = $Interactuable/CollisionShape2D

func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

func play_animationplayer(anim_name: String):
	$AnimationPlayer.play(anim_name)

func _ready():
	match get_tree().current_scene.name:
		"piso2":
			if !Estados.decision2_tomada:
				global_position = Vector2(2016, -41)
			elif Estados.decision2_tomada:
				if Estados.decision_3 == "mala":
					if Estados.nom == "Alex":
						global_position = Vector2(1917, -41)
			else:
				return

#func _process(_delta: float) -> void:
	#if Estados.decision_3 == "mala":
		#decision2_mala()
	#else:
		#return

func decision2_mala():
	var tween = create_tween()
	tween.tween_property(self, "position", Vector2(1917, -41), 1.0)
	interactuable.disabled = true
