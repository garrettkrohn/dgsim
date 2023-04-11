import {
  createTournamentParams,
  playerTournamentResource,
  tournamentResource,
  tournamentTitleResource,
} from './DTOs';

export async function getTournament(
  tournamentId: number,
): Promise<tournamentResource> {
  const url = `${
    import.meta.env.VITE_BACK_END_URL
  }/api/tournaments/${tournamentId}`;

  return await fetch(url, {
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
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/tournaments`;
  return await fetch(url, {
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
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/seasons`;
  return await fetch(url, {
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
  const url = `${
    import.meta.env.VITE_BACK_END_URL
  }/api/seasons/${seasonNumber}`;
  return await fetch(url, {
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

export async function getTournamentTitles(
  seasonNumber: number,
): Promise<tournamentTitleResource[]> {
  const url = `${
    import.meta.env.VITE_BACK_END_URL
  }/api/tournaments/titles/${seasonNumber}`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
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
  const url = `${
    import.meta.env.VITE_BACK_END_URL
  }/api/lastTournament/${Auth0}`;

  return await fetch(url, {
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
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/tournaments`;
  return await fetch(url, {
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
