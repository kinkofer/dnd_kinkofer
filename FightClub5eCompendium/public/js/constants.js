const Rune = {
    BLOOD: "blood",
    CLOUD: "cloud",
    DEATH: "death",
    DRAGON: "dragon",
    ENEMY: "enemy",
    FIRE: "fire",
    FRIEND: "friend",
    HILL: "hill",
    ICE: "ice",
    JOURNEY: "journey",
    KING: "king",
    LIFE: "life",
    LIGHT: "light",
    MOUNTAIN: "mountain",
    SACRED: "sacred",
    SHIELD: "shield",
    STONE: "stone",
    STORM: "storm",
    WAR: "war",
    WIND: "wind"
};
Object.freeze(Rune);


const Action = {
    CLEAR: Rune.DEATH,
    ACCEPT: Rune.JOURNEY,
    OPEN: [Rune.FIRE, Rune.STORM, Rune.MOUNTAIN, Rune.ICE]
};
Object.freeze(Action);


const Item = {
    DOOR: [Rune.CLOUD, Rune.FRIEND,	Rune.SACRED, Rune.LIFE]
};
Object.freeze(Item);


const SkyreachLocation = {
    REZMIR: [Rune.LIGHT, Rune.WIND, Rune.HILL, Rune.STONE]
};
Object.freeze(SkyreachLocation);
