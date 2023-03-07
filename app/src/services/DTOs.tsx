export interface tournamentResource {
  tournamentId: number;
  tournamentName: string;
  courseResponseDto: courseResource;
  season: number;
  playerTournaments: playerTournamentResource[];
}

export interface playerTournamentResource {
  playerTournamentId: number;
  tourPoints: number;
  totalScore: number;
  player_tournament_id: number;
  luckScore: number;
  place: number;
  playerResponseDto: playerResource;
  rounds: roundResource[];
}

export interface roundResource {
  roundId: number;
  roundTotal: number;
  luckScore: number;
  roundType: string;
  holeResults: holeResultResource[];
}

export interface holeResultResource {
  score: number;
  c1Putts: number;
  c2Putts: number;
  parked: boolean;
  c1inRegulation: boolean;
  c2inRegulation: boolean;
  scramble: boolean;
  luck: number;
  par: number;
}

export interface playerResource {
  player_id: number;
  first_name: string;
  last_name: string;
  putt_skill: number;
  throw_power_skill: number;
  throw_accuracy_skill: number;
  scramble_skill: number;
  start_season: number;
  is_active: boolean;
  banked_skill_points: number;
  archetype: object;
}

export interface courseResource {
  courseId: number;
  name: string;
  coursePar: number;
  holes: holesResource[];
}

export interface holesResource {
  c1Rate: number;
  c2Rate: number;
  courseId: number;
  holeId: number;
  par: number;
  parkedRate: number;
  scrambleRate: number;
}

export interface tournamentTitleResource {
  tournamentId: number;
  tournamentName: string;
  season: number;
}
