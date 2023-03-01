import { useAtom } from 'jotai';
import {
  currentPuttAtom,
  currentThrowPowerAtom,
  currentThrowAccuracyAtom,
  currentScrambleAtom,
} from '../../jotai/Atoms';

const PlayerBlock = () => {
  const [putt] = useAtom(currentPuttAtom);
  const [power] = useAtom(currentThrowPowerAtom);
  const [accuracy] = useAtom(currentThrowAccuracyAtom);
  const [scramble] = useAtom(currentScrambleAtom);

  return (
    <div className="container bg-dgsecondary p-2 text-dgsoftwhite">
      <div className="container flex justify-center">Paul McBeth</div>
      <div className="flex justify-evenly">
        <div className="flex flex-col">
          <div>Putt: {putt}</div>
          <div>scramble: {power}</div>
        </div>
        <div className="flex flex-col">
          <div>Throw Pwr: {accuracy}</div>
          <div>Throw Acc: {scramble}</div>
        </div>
      </div>
      <div></div>
    </div>
  );
};

export default PlayerBlock;
