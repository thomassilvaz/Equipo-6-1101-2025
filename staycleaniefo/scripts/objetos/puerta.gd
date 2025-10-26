extends Area2D

class_name Puerta

@export var destino_nivel_tag: String
@export var destino_puerta_tag: String
@export var spawn_direccion = "abajo"

@onready var spawn = $Spawn

#al entrar el nodo puerta realiza el cambio de escena y transmite la ubicacion del jugador
func _on_body_entered(body):
	if body is Jugador:
		var nodo_puerta = self.name
		match nodo_puerta:
			#caso explicito
			"Puerta_introduccion":
				if Estados.introduccion == true and !Estados.primera_clase:
					NavegacionManager.go_to_level(destino_nivel_tag, destino_puerta_tag)
				else:
					return
			_:
				NavegacionManager.go_to_level(destino_nivel_tag, destino_puerta_tag)
