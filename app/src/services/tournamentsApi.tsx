import {
  createTournamentParams,
  playerTournamentResource,
  tournamentResource,
  tournamentTitleResource,
} from './DTOs';

export async function getTournament(
  tournamentId: number,
): Promise<tournamentResource> {
  return await fetch(`http://localhost:8000/api/tournaments/${tournamentId}`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: tournamentResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getAllTournaments(): Promise<tournamentResource[]> {
  return await fetch(`http://localhost:8000/api/tournaments`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: tournamentResource[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getSeasons(): Promise<number[]> {
  return await fetch(`http://localhost:8000/api/seasons`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: number[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getTournamentBySeason(
  seasonNumber: number,
): Promise<tournamentResource[]> {
  return await fetch(
    `http://localhost:8000/api/tournaments/seasons/${seasonNumber}`,
    {
      headers: {
        'Content-Type': 'application/json',
      },
      method: 'GET',
    },
  )
    .then(response => response.json())
    .then((data: tournamentResource[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getTournamentTitles(
  seasonNumber: number,
): Promise<tournamentTitleResource[]> {
  return await fetch(
    `http://localhost:8000/api/tournaments/titles/${seasonNumber}`,
    {
      headers: {
        'Content-Type': 'application/json',
      },
      method: 'GET',
    },
  )
    .then(response => response.json())
    .then((data: tournamentTitleResource[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getLastTournament(
  Auth0: string,
): Promise<playerTournamentResource> {
  return await fetch(`http://localhost:8000/api/lastTournament/${Auth0}`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: playerTournamentResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function createTournament(
  params: createTournamentParams,
): Promise<tournamentResource> {
  return await fetch(`http://localhost:8000/api/tournaments`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'POST',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: tournamentResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
