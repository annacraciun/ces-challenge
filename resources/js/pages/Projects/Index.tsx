import { Head } from '@inertiajs/react';

interface Client {
    id: number;
    name: string;
}

interface Project {
    id: number;
    client_id: number;
    name: string;
    status: string;
    description: string | null;
    created_at: string | null;
    updated_at: string | null;
    client: Client;
}

interface IndexProps {
    projects: Project[];
    currentStatus: string | null;
}

export default function Index({ projects, currentStatus }: IndexProps) {
    const handleStatusChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const status = e.target.value;
    };

    return (
        <>
            <Head title="Projects" />
            <div className="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                <div className="sm:flex sm:items-center sm:justify-between">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">
                            Projects Overview
                        </h1>
                        <p className="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                            A list of all projects, their clients, and current status.
                        </p>
                    </div>

                    <div className="mt-4 sm:mt-0">
                        <label htmlFor="status-filter" className="sr-only">
                            Filter by Status
                        </label>
                        <select
                            id="status-filter"
                            value={currentStatus || ''}
                            onChange={handleStatusChange}
                            className="block w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-neutral-700 shadow-sm focus:border-neutral-500 focus:outline-none focus:ring-1 focus:ring-neutral-500 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 dark:focus:border-neutral-600"
                        >
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div className="mt-8 flex flex-col">
                    <div className="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div className="overflow-hidden shadow ring-1 ring-black/5 md:rounded-lg">
                                <table className="min-w-full divide-y divide-neutral-300 dark:divide-neutral-700">
                                    <thead className="bg-neutral-50 dark:bg-neutral-900">
                                        <tr>
                                            <th scope="col" className="py-3.5 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400 sm:pl-6">
                                                Project Name
                                            </th>
                                            <th scope="col" className="px-3 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                                                Client
                                            </th>
                                            <th scope="col" className="px-3 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                                                Status
                                            </th>
                                            <th scope="col" className="px-3 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                                                Description
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody className="divide-y divide-neutral-200 bg-white dark:divide-neutral-700 dark:bg-neutral-800">
                                        {projects.length === 0 ? (
                                            <tr>
                                                <td colSpan={4} className="whitespace-nowrap py-10 text-center text-sm text-neutral-500 dark:text-neutral-400">
                                                    No projects found.
                                                </td>
                                            </tr>
                                        ) : (
                                            projects.map((project) => (
                                                <tr key={project.id}>
                                                    <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-neutral-900 dark:text-neutral-100 sm:pl-6">
                                                        {project.name}
                                                    </td>
                                                    <td className="whitespace-nowrap px-3 py-4 text-sm text-neutral-500 dark:text-neutral-300">
                                                        {project.client?.name}
                                                    </td>
                                                    <td className="whitespace-nowrap px-3 py-4 text-sm">
                                                        <span className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${
                                                            project.status === 'active'
                                                                ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                                                                : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400'
                                                        }`}>
                                                            {project.status}
                                                        </span>
                                                    </td>
                                                    <td className="px-3 py-4 text-sm text-neutral-500 dark:text-neutral-300 max-w-xs truncate">
                                                        {project.description}
                                                    </td>
                                                </tr>
                                            ))
                                        )}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

Index.layout = {
    breadcrumbs: [
        {
            title: 'Projects',
            href: '/projects',
        },
    ],
};
