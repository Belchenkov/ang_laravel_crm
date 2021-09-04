export interface Status {
  id: number;
  title: string;
}

export const STATUSES = {
  NEW: 1,
  PROCESS: 2,
  DONE: 3,
};
