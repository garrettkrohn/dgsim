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
  coursePar: number;
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
  c1InRegulation: boolean;
  c2InRegulation: boolean;
  scramble: boolean;
  luck: number;
  par: number;
}

export interface playerResource {
  playerId: number;
  firstName: string;
  lastName: string;
  puttSkill: number;
  throwPowerSkill: number;
  throwAccuracySkill: number;
  scrambleSkill: number;
  startSeason: number;
  isActive: boolean;
  bankedSkillPoints: number;
  archetype: archetypeResource;
}

export interface archetypeResource {
  archetype_id: number;
  name: string;
  min_putt_skill: number;
  min_throw_power_skill: number;
  min_throw_accuracy_skill: number;
  min_scramble_skill: number;
  max_putt_skill: number;
  max_throw_power_skill: number;
  max_throw_accuracy_skill: number;
  max_scramble_skill: number;
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

export interface allSeasonStandings {
  season: number;
  standings: seasonStandingResource[];
}

export interface seasonStandingResource {
  player: playerResource;
  seasonTotal: number;
  rank: number;
}

export interface coursesNamesResource {
  courseId: number;
  courseName: string;
}

export interface createTournamentParams {
  tournamentName: string;
  courseId: number;
  season: number;
  numberOfRounds: number;
}

export interface archetypeResource {
  archetypeId: number;
  name: string;
  minPuttSkill: number;
  minThrowPowerSkill: number;
  minThrowAccuracySkill: number;
  minScrambleSkill: number;
  maxPuttSkill: number;
  maxThrowPowerSkill: number;
  maxThrowAccuracySkill: number;
  maxScrambleSkill: number;
}

export interface createPlayerParams {
  firstName: string;
  lastName: string;
  puttSkill: number;
  throwPowerSkill: number;
  throwAccuracySkill: number;
  scrambleSkill: number;
  startSeason: number;
  archetypeId: number;
  bankedSkillPoints: number;
  auth0: string;
}

export interface createOrGetUserParams {
  Auth0: string;
}

export interface userResource {
  userId: number;
  role: {
    role_id: 2;
    name: string;
  };
  email: string;
  auth0: string;
}

export interface getUserByAuthParams {
  Auth0: string;
}

export interface updatePlayerParams {
  firstName: string;
  lastName: string;
  puttSkill: number;
  throwPowerSkill: number;
  throwAccuracySkill: number;
  scrambleSkill: number;
  startSeason: number;
  bankedSkillPoints: number;
  archetypeId: number;
  playerId: number;
  auth0: string;
}
