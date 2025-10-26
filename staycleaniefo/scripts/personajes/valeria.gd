extends CharacterBody2D

@onready var colision = $CollisionShape2D
@onready var interactuable = $Interactuable/CollisionShape2D

#funcion que al llamarse activa una animacion del sprite manualmente
func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

#funcion que al llamarse activa una animacion de su animationplayer
func play_animationplayer(anim_name: String):
	$AnimationPlayer.play(anim_name)

#determina la posicion del personaje segun la escena y las condiciones activas
func _ready() -> void:
	match get_tree().current_scene.name:
		"piso1":
			if Estados.charla_con_valeria:
				if !Estados.caminar_cafeteria:
					global_position = Vector2(341, 19)
				else:
					global_position = Vector2(-251, 873)
			else:
				global_position = Vector2(-186,-658)

#funcion que al llamarse determina si activar o desactivar por completo el personaje
func visibilidad_npc(visibilidad: bool):
	if visibilidad:
		show()
		colision.disabled = false
		interactuable.disabled = false
	else:
		hide()
		colision.disabled = true
		interactuable.disabled = true

#funcion que al llamarse, activa o desactiva el nodo de dialogo
func toggle_dialogo(toggle: bool):
	interactuable.disabled(toggle)
