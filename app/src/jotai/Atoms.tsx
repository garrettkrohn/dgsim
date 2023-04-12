import { atom } from 'jotai/index';
import { userResource } from '../services/DTOs';

export const updatePuttAtom = atom(-1);
export const updateThrowPowerAtom = atom(0);
export const updateThrowAccuracyAtom = atom(0);
export const updateScrambleAtom = atom(0);
export const updateAvailableSpAtom = atom(300);
export const currentPuttAtom = atom(0);
export const currentThrowPowerAtom = atom(0);
export const currentThrowAccuracyAtom = atom(0);
export const currentScrambleAtom = atom(0);
export const createPlayerAvailableSp = atom(0);

const defaultUser = {
  userId: 0,
  role: {
    roleid: 2,
    name: 'user',
  },
  auth0: 'auth',
  avatarBackgroundColor: '#FF0000',
  avatarTextColor: '#000000',
  backgroundColor: '#FF0000',
  foregroundColor: '#FF0000',
};

export const loggedInUser = atom(defaultUser as userResource);

export const customColors = atom(false);
